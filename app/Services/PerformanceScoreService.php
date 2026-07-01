<?php

namespace App\Services;

use App\Models\Setting;

class PerformanceScoreService
{
    /**
     * Get score for a specific activity type.
     */
    public function getScoreForActivity(string $activityType): int
    {
        switch (strtolower($activityType)) {
            case 'walk-in':
            case 'walk_in':
                return (int) Setting::get('walk_in_score', 1);
                
            case 'registration':
            case 'registered':
                return (int) Setting::get('registration_score', 1);
                
            case 'admission':
            case 'admitted':
                return (int) Setting::get('admission_score', 4);
                
            case 'full payment':
            case 'full_payment':
                return (int) Setting::get('payment_score', 6);
                
            default:
                return 0; // Other statuses like Lost, Cancelled, Follow-up do not add score
        }
    }
}
