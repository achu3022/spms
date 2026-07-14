<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityManagementController extends Controller
{
    public function index(Request $request)
    {
        $activities = collect(); // Default empty collection
        
        $hasFilters = $request->has('employee_id') && $request->employee_id != '' 
            && $request->has('filter_date') && $request->filter_date != '';

        if ($hasFilters) {
            $query = Activity::with(['employee', 'team'])->orderBy('created_at', 'desc');
            $query->where('employee_id', $request->employee_id);
            $query->whereDate('created_at', $request->filter_date);
            $activities = $query->get(); // No need to paginate if filtering by single day
        }

        $users = User::orderBy('name')->get();

        return view('activities_manage.index', compact('activities', 'users', 'hasFilters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|integer',
            'created_at' => 'required|date',
            'remarks' => 'nullable|string'
        ]);

        $activity = Activity::findOrFail($id);
        $activity->score = $request->score;
        $activity->created_at = $request->created_at;
        $activity->remarks = $request->remarks;
        $activity->save();

        return redirect()->back()->with('success', 'Activity updated successfully.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->back()->with('success', 'Activity deleted successfully.');
    }

    public function adjust(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'score' => 'required|integer',
            'remarks' => 'required|string|max:255'
        ]);

        $user = User::findOrFail($request->employee_id);
        $teamId = $user->team->id ?? null;

        Activity::create([
            'employee_id' => $user->id,
            'team_id' => $teamId,
            'activity_type' => 'Manual Adjustment',
            'score' => $request->score,
            'remarks' => $request->remarks,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Score adjustment applied to ' . $user->name . '.');
    }
}
