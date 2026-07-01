<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyClosingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'closing_type' => 'required|string',
            'count' => 'required|integer|min:1',
            'date' => 'required|date'
        ]);

        $date = \Carbon\Carbon::parse($request->date)->startOfDay();
        $today = now()->startOfDay();

        // Enforce the rule: can only submit for today
        if ($date->notEqualTo($today)) {
            return back()->with('error', 'You can only submit daily closings for today.');
        }

        \App\Models\DailyClosing::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'date' => $date->format('Y-m-d'),
                'closing_type' => $request->closing_type,
            ],
            [
                'count' => $request->count
            ]
        );

        $scoreMultiplier = match($request->closing_type) {
            'Walk-in' => \App\Models\Setting::get('walk_in_score', 1),
            'Registration' => \App\Models\Setting::get('registration_score', 1),
            'Admission' => \App\Models\Setting::get('admission_score', 4),
            'Full Payment' => \App\Models\Setting::get('admission_score', 4) + \App\Models\Setting::get('payment_score', 6),
            default => 0,
        };

        $totalScore = $request->count * $scoreMultiplier;

        // Remove any existing bulk activity for this user/type/day to avoid duplicate points on update
        \App\Models\Activity::where('employee_id', auth()->id())
            ->whereDate('created_at', $date->format('Y-m-d'))
            ->where('activity_type', $request->closing_type)
            ->whereNull('enquiry_id')
            ->delete();

        // Log the activity to update points and show in team feeds
        \App\Models\Activity::create([
            'employee_id' => auth()->id(),
            'team_id' => auth()->user()->team->id ?? null,
            'activity_type' => $request->closing_type,
            'remarks' => "Bulk entry: {$request->count} {$request->closing_type}",
            'score' => $totalScore,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Daily closing added successfully.');
    }
}
