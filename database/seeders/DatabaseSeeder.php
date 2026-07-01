<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EmployeeProfile;
use App\Models\Team;
use App\Models\Branch;
use App\Models\Course;
use App\Models\LeadSource;
use App\Models\State;
use App\Models\District;
use App\Models\Setting;
use App\Models\Enquiry;
use App\Models\Activity;
use App\Models\FollowUp;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Application Score & Branding Settings
        $this->command->info('Seeding Application Settings...');
        Setting::set('walk_in_score', 1);
        Setting::set('registration_score', 1);
        Setting::set('admission_score', 4);
        Setting::set('payment_score', 6);
        Setting::set('brand_color_primary', '#2D318F');
        Setting::set('brand_color_secondary', '#0070BC');
        Setting::set('brand_color_accent', '#00AA9E');

        // 2. Seed Spatie Roles
        $this->command->info('Seeding Spatie Roles...');
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $salesHead = Role::create(['name' => 'Sales Head (HOD)']);
        $teamLeader = Role::create(['name' => 'Team Leader']);
        $viceLeader = Role::create(['name' => 'Vice Team Leader']);
        $executive = Role::create(['name' => 'Sales Executive']);

        // 3. Seed Branches
        $this->command->info('Seeding Branches...');
        $branches = ['Kochi', 'Trivandrum', 'Chennai', 'Bangalore', 'Calicut'];
        $branchModels = [];
        foreach ($branches as $b) {
            $branchModels[] = Branch::create([
                'name' => $b,
                'code' => strtoupper(substr($b, 0, 3)),
                'status' => 'active'
            ]);
        }

        // 4. Seed Courses
        $this->command->info('Seeding Courses...');
        $courses = [
            ['name' => 'PG Diploma in Industrial Automation', 'code' => 'PGDIA', 'duration_months' => 4, 'fee' => 45000.00],
            ['name' => 'Embedded Systems & IoT', 'code' => 'EMB', 'duration_months' => 3, 'fee' => 35000.00],
            ['name' => 'Python Full Stack Development', 'code' => 'PYFS', 'duration_months' => 4, 'fee' => 40000.00],
            ['name' => 'Data Science & Machine Learning', 'code' => 'DSML', 'duration_months' => 5, 'fee' => 55000.00]
        ];
        $courseModels = [];
        foreach ($courses as $c) {
            $courseModels[] = Course::create($c);
        }

        // 5. Seed Lead Sources
        $this->command->info('Seeding Lead Sources...');
        $sources = ['Google Ads', 'Instagram Ads', 'Direct Walk-in', 'Student Reference', 'Website Contact Form'];
        $sourceModels = [];
        foreach ($sources as $s) {
            $sourceModels[] = LeadSource::create(['name' => $s]);
        }

        // 6. Seed States & Districts
        $this->command->info('Seeding States & Districts...');
        $kerala = State::create(['name' => 'Kerala']);
        $districts = ['Ernakulam', 'Trivandrum', 'Kozhikode', 'Thrissur'];
        $districtModels = [];
        foreach ($districts as $d) {
            $districtModels[] = District::create(['state_id' => $kerala->id, 'name' => $d]);
        }

        // 7. Seed Admin Users
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@smeclabs.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole('Super Admin');
        EmployeeProfile::create([
            'user_id' => $admin->id,
            'employee_id' => 'SMEC-ADMIN-01',
            'phone' => '9876543210',
            'designation' => 'System Administrator',
            'status' => 'active'
        ]);

        $hod = User::create([
            'name' => 'Sales Head HOD',
            'email' => 'hod@smeclabs.com',
            'password' => Hash::make('password')
        ]);
        $hod->assignRole('Sales Head (HOD)');
        EmployeeProfile::create([
            'user_id' => $hod->id,
            'employee_id' => 'SMEC-HOD-01',
            'phone' => '9876543211',
            'designation' => 'Sales Head (HOD)',
            'status' => 'active'
        ]);

        // 8. Dynamic Team Definition (as specified by user)
        $teamsDefinition = [
            [
                'name' => 'Team Suhail',
                'leader' => 'Suhail',
                'vice' => 'Jewel',
                'members' => ['Aswathy', 'Veena', 'Nandana', 'Niranjana']
            ],
            [
                'name' => 'Team Manikandan',
                'leader' => 'Manikandan',
                'vice' => 'Pranav',
                'members' => ['Divya', 'Praseetha', 'Sicily']
            ],
            [
                'name' => 'Team Pramod',
                'leader' => 'Pramod',
                'vice' => 'Anjitha',
                'members' => ['Saranya', 'Akhila', 'Gouri']
            ],
            [
                'name' => 'Team Sanu',
                'leader' => 'Sanu',
                'vice' => 'Amal',
                'members' => ['Arunima', 'Keerthana', 'Soumya']
            ],
            [
                'name' => 'Team Midhun',
                'leader' => 'Midhun P Das',
                'vice' => 'Sabi',
                'members' => ['Shilja', 'Jeeva']
            ]
        ];

        $empCounter = 100;
        $enqCounter = 1;

        foreach ($teamsDefinition as $tIdx => $tDef) {
            // Create Team
            $team = Team::create([
                'name' => $tDef['name'],
                'description' => "Sales team led by Captain " . $tDef['leader']
            ]);

            // Create Team Leader User
            $leaderEmail = strtolower(str_replace(' ', '', $tDef['leader'])) . '@smeclabs.com';
            $leaderUser = User::create([
                'name' => $tDef['leader'],
                'email' => $leaderEmail,
                'password' => Hash::make('password')
            ]);
            $leaderUser->assignRole('Team Leader');
            EmployeeProfile::create([
                'user_id' => $leaderUser->id,
                'employee_id' => 'SMEC-EMP-' . $empCounter++,
                'phone' => '9000000' . $empCounter,
                'whatsapp' => '9000000' . $empCounter,
                'designation' => 'Team Leader',
                'status' => 'active'
            ]);

            // Create Vice Team Leader User
            $viceEmail = strtolower(str_replace(' ', '', $tDef['vice'])) . '@smeclabs.com';
            $viceUser = User::create([
                'name' => $tDef['vice'],
                'email' => $viceEmail,
                'password' => Hash::make('password')
            ]);
            $viceUser->assignRole('Vice Team Leader');
            EmployeeProfile::create([
                'user_id' => $viceUser->id,
                'employee_id' => 'SMEC-EMP-' . $empCounter++,
                'phone' => '9000000' . $empCounter,
                'whatsapp' => '9000000' . $empCounter,
                'designation' => 'Vice Team Leader',
                'status' => 'active'
            ]);

            // Map Pivot memberships
            DB::table('team_members')->insert([
                ['team_id' => $team->id, 'user_id' => $leaderUser->id, 'role' => 'leader', 'created_at' => now(), 'updated_at' => now()],
                ['team_id' => $team->id, 'user_id' => $viceUser->id, 'role' => 'vice_leader', 'created_at' => now(), 'updated_at' => now()]
            ]);

            // Create regular member accounts
            $memberUsers = [];
            foreach ($tDef['members'] as $mName) {
                $mEmail = strtolower(str_replace(' ', '', $mName)) . '@smeclabs.com';
                $mUser = User::create([
                    'name' => $mName,
                    'email' => $mEmail,
                    'password' => Hash::make('password')
                ]);
                $mUser->assignRole('Sales Executive');
                EmployeeProfile::create([
                    'user_id' => $mUser->id,
                    'employee_id' => 'SMEC-EMP-' . $empCounter++,
                    'phone' => '9000000' . $empCounter,
                    'whatsapp' => '9000000' . $empCounter,
                    'designation' => 'Sales Executive',
                    'status' => 'active'
                ]);

                DB::table('team_members')->insert([
                    'team_id' => $team->id,
                    'user_id' => $mUser->id,
                    'role' => 'member',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                $memberUsers[] = $mUser;
            }

            // Simulate student enquiries and point activities for all team members (including L & VC)
            $allTeamUsers = array_merge([$leaderUser, $viceUser], $memberUsers);
            foreach ($allTeamUsers as $uIdx => $u) {
                $enqStatus = ['New', 'Walk-in', 'Registered', 'Admitted', 'Full Payment'][$uIdx % 5];
                $year = date('Y');
                $enqNum = 'SMEC-ENQ-' . $year . '-' . str_pad($enqCounter++, 5, '0', STR_PAD_LEFT);

                $enquiry = Enquiry::create([
                    'enquiry_number' => $enqNum,
                    'student_name' => "Student Candidate of " . $u->name,
                    'phone_number' => '9900000' . str_pad($enqCounter, 3, '0', STR_PAD_LEFT),
                    'whatsapp_number' => '9900000' . str_pad($enqCounter, 3, '0', STR_PAD_LEFT),
                    'email' => "candidate{$enqCounter}@example.com",
                    'place' => 'Metro Junction',
                    'state_id' => $kerala->id,
                    'district_id' => $districtModels[$uIdx % 4]->id,
                    'course_id' => $courseModels[$uIdx % 4]->id,
                    'branch_id' => $branchModels[$uIdx % 5]->id,
                    'lead_source_id' => $sourceModels[$uIdx % 5]->id,
                    'assigned_employee_id' => $u->id,
                    'assigned_team_id' => $team->id,
                    'current_status' => $enqStatus,
                    'remarks' => "Initial enquiry details logged.",
                    'total_score' => 0
                ]);

                $this->simulateEnquiryTimeline($enquiry, $u, $team, $enqStatus);
            }
        }
    }

    protected function simulateEnquiryTimeline(Enquiry $enquiry, User $exec, Team $team, string $targetStatus): void
    {
        $stages = ['New', 'Walk-in', 'Registered', 'Admitted', 'Full Payment'];
        $statusIndex = array_search($targetStatus, $stages);
        
        if ($statusIndex === false) {
            Activity::create([
                'enquiry_id' => $enquiry->id,
                'employee_id' => $exec->id,
                'team_id' => $team->id,
                'activity_type' => 'New',
                'remarks' => 'Initial enquiry created.',
                'score' => 0,
                'created_at' => now()->subDays(2)
            ]);
            return;
        }

        for ($i = 0; $i <= $statusIndex; $i++) {
            $stage = $stages[$i];
            $score = 0;
            $daysAgo = ($statusIndex - $i) * 2;
            $timestamp = now()->subDays($daysAgo);

            if ($stage === 'Walk-in') $score = 1;
            elseif ($stage === 'Registered') $score = 1;
            elseif ($stage === 'Admitted') $score = 4;
            elseif ($stage === 'Full Payment') $score = 6;

            Activity::create([
                'enquiry_id' => $enquiry->id,
                'employee_id' => $exec->id,
                'team_id' => $team->id,
                'activity_type' => $stage,
                'remarks' => "Logged {$stage} event for {$enquiry->student_name}.",
                'score' => $score,
                'created_at' => $timestamp
            ]);

            if ($stage === 'Admitted' && $targetStatus === 'Admitted') {
                Payment::create([
                    'enquiry_id' => $enquiry->id,
                    'employee_id' => $exec->id,
                    'admission_amount' => 45000.00,
                    'discount' => 5000.00,
                    'scholarship' => 0.00,
                    'paid_amount' => 10000.00,
                    'balance' => 30000.00,
                    'payment_mode' => 'UPI',
                    'transaction_number' => 'TXN' . rand(100000, 999999),
                    'receipt_number' => 'REC-2026-' . rand(1000, 9999),
                    'created_at' => $timestamp
                ]);
            }

            if ($stage === 'Full Payment' && $targetStatus === 'Full Payment') {
                Payment::create([
                    'enquiry_id' => $enquiry->id,
                    'employee_id' => $exec->id,
                    'admission_amount' => 45000.00,
                    'discount' => 5000.00,
                    'scholarship' => 0.00,
                    'paid_amount' => 40000.00,
                    'balance' => 0.00,
                    'payment_mode' => 'NetBanking',
                    'transaction_number' => 'TXN' . rand(100000, 999999),
                    'receipt_number' => 'REC-2026-' . rand(1000, 9999),
                    'created_at' => $timestamp
                ]);
            }
        }

        // Cache total score
        $enquiry->total_score = $enquiry->activities()->sum('score');
        $enquiry->saveQuietly();
    }
}
