<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Team;
use App\Models\Activity;
use App\Models\LeaderboardArchive;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MonthlyResetCommand extends Command
{
    protected $signature = 'spms:monthly-reset';
    protected $description = 'Archive previous month scores and reset active leaderboard';

    public function handle()
    {
        $this->info('Archiving previous month leaderboard...');

        // Archiving previous month
        $previousMonth = now()->subMonth();
        $month = $previousMonth->month;
        $year = $previousMonth->year;

        // Archive employee scores
        $users = User::all();
        $employeeScores = [];

        foreach ($users as $user) {
            $score = Activity::where('employee_id', $user->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('score');
            
            $employeeScores[] = [
                'entity_id' => $user->id,
                'name' => $user->name,
                'score' => $score
            ];
        }

        // Sort descending by score
        usort($employeeScores, fn($a, $b) => $b['score'] <=> $a['score']);
        
        // Write archives with ranks
        $rank = 1;
        foreach ($employeeScores as $record) {
            LeaderboardArchive::updateOrCreate(
                [
                    'month' => $month,
                    'year' => $year,
                    'archive_type' => 'employee',
                    'entity_id' => $record['entity_id']
                ],
                [
                    'name' => $record['name'],
                    'score' => $record['score'],
                    'rank' => $rank++
                ]
            );
        }

        // Archive team scores
        $teams = Team::all();
        $teamScores = [];

        foreach ($teams as $team) {
            $score = Activity::where('team_id', $team->id)
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->sum('score');

            $teamScores[] = [
                'entity_id' => $team->id,
                'name' => $team->name,
                'score' => $score
            ];
        }

        usort($teamScores, fn($a, $b) => $b['score'] <=> $a['score']);

        $rank = 1;
        foreach ($teamScores as $record) {
            LeaderboardArchive::updateOrCreate(
                [
                    'month' => $month,
                    'year' => $year,
                    'archive_type' => 'team',
                    'entity_id' => $record['entity_id']
                ],
                [
                    'name' => $record['name'],
                    'score' => $record['score'],
                    'rank' => $rank++
                ]
            );
        }

        $this->info("Leaderboards archived successfully for month: {$month}, year: {$year}!");
    }
}
