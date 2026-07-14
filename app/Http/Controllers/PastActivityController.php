<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DailyClosing;
use App\Models\Activity;
use App\Services\PerformanceScoreService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PastActivityController extends Controller
{
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('past_activities.create', compact('users'));
    }

    public function getExisting(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date'
        ]);

        $data = DailyClosing::where('user_id', $request->employee_id)
            ->whereDate('date', $request->date)
            ->pluck('count', 'closing_type');

        return response()->json($data);
    }

    public function store(Request $request, PerformanceScoreService $scoreService)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date|before_or_equal:today',
            'walk_in' => 'nullable|integer|min:0',
            'registration' => 'nullable|integer|min:0',
            'admission' => 'nullable|integer|min:0',
            'full_payment' => 'nullable|integer|min:0',
        ]);

        $user = User::findOrFail($request->employee_id);
        $date = $request->date;
        $createdAt = Carbon::parse($date)->setHour(12)->setMinute(0)->setSecond(0);
        $teamId = $user->team->id ?? null;

        $metrics = [
            'Walk-in' => $request->walk_in ?? 0,
            'Registration' => $request->registration ?? 0,
            'Admission' => $request->admission ?? 0,
            'Full Payment' => $request->full_payment ?? 0,
        ];

        foreach ($metrics as $type => $count) {
            $closing = DailyClosing::firstOrCreate([
                'user_id' => $user->id,
                'date' => $date,
                'closing_type' => $type,
            ]);

            $closing->count = $count;
            $closing->save();

            // Sync activities
            $score = $scoreService->getScoreForActivity($type);

            $currentActivities = Activity::where('employee_id', $user->id)
                ->where('activity_type', $type)
                ->whereDate('created_at', $date)
                ->get();

            $currentCount = $currentActivities->count();

            if ($count > $currentCount) {
                // Add missing activities
                $toAdd = $count - $currentCount;
                for ($i = 0; $i < $toAdd; $i++) {
                    $activity = new Activity([
                        'employee_id' => $user->id,
                        'team_id' => $teamId,
                        'activity_type' => $type,
                        'score' => $score,
                        'remarks' => 'Added manually by Admin',
                    ]);
                    $activity->created_at = $createdAt;
                    $activity->updated_at = $createdAt;
                    $activity->save();
                }
            } elseif ($count < $currentCount) {
                // Remove extra activities
                $toRemove = $currentCount - $count;
                $activitiesToDelete = $currentActivities->take($toRemove);
                foreach ($activitiesToDelete as $act) {
                    $act->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'Past activities successfully updated for ' . $user->name . ' on ' . $date . '.');
    }
}
