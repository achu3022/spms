<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    protected $auditService;

    public function __construct(AuditLogService $auditService)
    {
        $this->auditService = $auditService;
    }

    public function index()
    {
        $teams = Team::with(['users', 'leaders', 'viceLeaders'])->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $users = User::all();
        return view('teams.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:teams,name|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
            'vice_leader_id' => 'nullable|exists:users,id|different:leader_id',
            'member_ids' => 'nullable|array',
            'member_ids.*' => 'exists:users,id',
        ], [
            'vice_leader_id.different' => 'The Vice Leader cannot be the same person as the Team Leader.'
        ]);

        DB::transaction(function () use ($request) {
            $team = Team::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $this->syncTeamRelations($team, $request->leader_id, $request->vice_leader_id, $request->member_ids ?? []);
        });

        return redirect()->route('teams.index')->with('success', 'Team created and members assigned successfully.');
    }

    public function edit(Team $team)
    {
        $users = User::all();
        $team->load(['users']);
        
        $currentLeaderId = $team->leader?->id;
        $currentViceLeaderId = $team->viceLeader?->id;
        $currentMemberIds = $team->regularMembers()->pluck('users.id')->toArray();

        return view('teams.edit', compact('team', 'users', 'currentLeaderId', 'currentViceLeaderId', 'currentMemberIds'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
            'vice_leader_id' => 'nullable|exists:users,id|different:leader_id',
            'member_ids' => 'nullable|array',
            'member_ids.*' => 'exists:users,id',
        ], [
            'vice_leader_id.different' => 'The Vice Leader cannot be the same person as the Team Leader.'
        ]);

        DB::transaction(function () use ($request, $team) {
            $team->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $this->syncTeamRelations($team, $request->leader_id, $request->vice_leader_id, $request->member_ids ?? []);
        });

        return redirect()->route('teams.index')->with('success', 'Team updated and members synchronized.');
    }

    public function destroy(Team $team)
    {
        DB::transaction(function () use ($team) {
            // Delete members association
            DB::table('team_members')->where('team_id', $team->id)->delete();
            $team->delete();
        });

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }

    protected function syncTeamRelations(Team $team, ?int $leaderId, ?int $viceLeaderId, array $memberIds): void
    {
        // Get list of currently associated users in this team to log audits later
        $oldUserIds = DB::table('team_members')->where('team_id', $team->id)->pluck('user_id')->toArray();

        // 1. Remove all these users from their current team assignments (since a user can only be in one team)
        $allTargetUsers = array_filter(array_merge([$leaderId, $viceLeaderId], $memberIds));
        
        foreach ($allTargetUsers as $userId) {
            $oldTeamMember = DB::table('team_members')->where('user_id', $userId)->first();
            $oldTeam = $oldTeamMember ? Team::find($oldTeamMember->team_id) : null;
            
            if ($oldTeamMember && $oldTeamMember->team_id !== $team->id) {
                // User is being transferred from another team
                DB::table('team_members')->where('user_id', $userId)->delete();
                $employee = User::find($userId);
                if ($employee) {
                    $this->auditService->logTransfer($employee, $oldTeam, $team);
                }
            } elseif (!$oldTeamMember) {
                // User joins team for the first time
                $employee = User::find($userId);
                if ($employee) {
                    $this->auditService->logTransfer($employee, null, $team);
                }
            }
        }

        // 2. Delete all existing mappings for THIS team to overwrite
        DB::table('team_members')->where('team_id', $team->id)->delete();

        // 3. Write new mappings
        if ($leaderId) {
            DB::table('team_members')->insert([
                'team_id' => $team->id,
                'user_id' => $leaderId,
                'role' => 'leader',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        if ($viceLeaderId && $viceLeaderId != $leaderId) {
            DB::table('team_members')->insert([
                'team_id' => $team->id,
                'user_id' => $viceLeaderId,
                'role' => 'vice_leader',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $uniqueMemberIds = array_unique($memberIds);
        foreach ($uniqueMemberIds as $mId) {
            // Avoid duplicate entry if member is also leader/vice_leader
            if ($mId == $leaderId || $mId == $viceLeaderId) {
                continue;
            }
            DB::table('team_members')->insert([
                'team_id' => $team->id,
                'user_id' => $mId,
                'role' => 'member',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
