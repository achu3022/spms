<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyClosingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'walkin_count' => 'nullable|integer|min:0',
            'registration_count' => 'nullable|integer|min:0',
            'admission_count' => 'nullable|integer|min:0',
            'payment_count' => 'nullable|integer|min:0',
        ]);

        $date = \Carbon\Carbon::parse($request->date)->startOfDay();
        $today = now()->startOfDay();

        // Enforce the rule: can only submit for today
        if ($date->notEqualTo($today)) {
            return back()->with('error', 'You can only submit daily closings for today.');
        }

        $entries = [
            'Walk-in' => [
                'count' => (int) $request->walkin_count,
                'score_per_unit' => (int) \App\Models\Setting::get('walk_in_score', 1)
            ],
            'Registration' => [
                'count' => (int) $request->registration_count,
                'score_per_unit' => (int) \App\Models\Setting::get('registration_score', 2)
            ],
            'Admission' => [
                'count' => (int) $request->admission_count,
                'score_per_unit' => (int) \App\Models\Setting::get('admission_score', 4)
            ],
            'Full Payment' => [
                'count' => (int) $request->payment_count,
                'score_per_unit' => (int) \App\Models\Setting::get('payment_score', 6)
            ],
        ];

        foreach ($entries as $type => $data) {
            if ($data['count'] > 0) {
                $dailyClosing = \App\Models\DailyClosing::firstOrNew([
                    'user_id' => auth()->id(),
                    'date' => $date->format('Y-m-d'),
                    'closing_type' => $type,
                ]);
                $dailyClosing->count = ($dailyClosing->count ?? 0) + $data['count'];
                $dailyClosing->save();

                $totalScore = $data['count'] * $data['score_per_unit'];

                // Log the new activity to add points (does not delete previous entries for the day)
                \App\Models\Activity::create([
                    'employee_id' => auth()->id(),
                    'team_id' => auth()->user()->team->id ?? null,
                    'activity_type' => $type,
                    'remarks' => "Bulk entry: {$data['count']} {$type}",
                    'score' => $totalScore,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return back()->with('success', 'Daily closing added successfully.');
    }
}
