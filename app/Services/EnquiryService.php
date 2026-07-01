<?php

namespace App\Services;

use App\Models\Enquiry;
use App\Models\Activity;
use App\Models\FollowUp;
use App\Models\Payment;
use App\Repositories\EnquiryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnquiryService
{
    protected $enquiryRepository;
    protected $scoreService;

    public function __construct(
        EnquiryRepositoryInterface $enquiryRepository,
        PerformanceScoreService $scoreService
    ) {
        $this->enquiryRepository = $enquiryRepository;
        $this->scoreService = $scoreService;
    }

    /**
     * Create a new Enquiry and log the initial activity.
     */
    public function createEnquiry(array $data): Enquiry
    {
        return DB::transaction(function () use ($data) {
            // Generate enquiry number, e.g. SMEC-ENQ-2026-00001
            $data['enquiry_number'] = $this->generateEnquiryNumber();
            
            // Set default status if not provided
            $status = $data['current_status'] ?? 'New';
            $data['current_status'] = $status;

            // Fetch assigned employee's active team
            $employeeId = $data['assigned_employee_id'] ?? Auth::id();
            $data['assigned_employee_id'] = $employeeId;
            
            $employee = \App\Models\User::find($employeeId);
            $team = $employee ? $employee->team : null;
            $data['assigned_team_id'] = $team ? $team->id : null;

            // Create enquiry
            $enquiry = $this->enquiryRepository->create($data);

            // Log activity and assign score if status warrants it
            $this->logActivity($enquiry, $status, $data['remarks'] ?? 'Initial enquiry created.');

            return $enquiry;
        });
    }

    /**
     * Update an Enquiry and log status change if status changed.
     */
    public function updateEnquiry(Enquiry $enquiry, array $data): bool
    {
        return DB::transaction(function () use ($enquiry, $data) {
            $oldStatus = $enquiry->current_status;
            $newStatus = $data['current_status'] ?? $oldStatus;

            // Update assigned employee and team
            if (!empty($data['assigned_employee_id']) && $data['assigned_employee_id'] != $enquiry->assigned_employee_id) {
                $employee = \App\Models\User::find($data['assigned_employee_id']);
                $team = $employee ? $employee->team : null;
                $data['assigned_team_id'] = $team ? $team->id : null;
            }

            // Save changes
            $updated = $this->enquiryRepository->update($enquiry, $data);

            // If status changed, log new activity and compute scores
            if ($updated && $oldStatus !== $newStatus) {
                $this->logActivity($enquiry, $newStatus, $data['remarks'] ?? "Status updated from {$oldStatus} to {$newStatus}.");
            }

            return $updated;
        });
    }

    /**
     * Add a follow-up to an enquiry.
     */
    public function addFollowUp(Enquiry $enquiry, array $data): FollowUp
    {
        return DB::transaction(function () use ($enquiry, $data) {
            $data['enquiry_id'] = $enquiry->id;
            $data['employee_id'] = Auth::id();
            
            $followUp = FollowUp::create($data);

            // Update enquiry status to 'Follow-up' and log it
            $enquiry->update(['current_status' => 'Follow-up']);
            $this->logActivity($enquiry, 'Follow-up', $data['remarks'] ?? 'Scheduled new follow-up.');

            return $followUp;
        });
    }

    /**
     * Add a payment details entry.
     */
    public function addPayment(Enquiry $enquiry, array $data): Payment
    {
        return DB::transaction(function () use ($enquiry, $data) {
            $data['enquiry_id'] = $enquiry->id;
            $data['employee_id'] = Auth::id();

            $payment = Payment::create($data);

            // Determine if full payment or just admission paid
            $balance = (float)$data['balance'];
            $status = ($balance <= 0) ? 'Full Payment' : 'Admitted';

            $enquiry->update(['current_status' => $status]);
            $this->logActivity($enquiry, $status, "Payment recorded. Receipt: {$payment->receipt_number}. Paid: {$payment->paid_amount}. Balance: {$payment->balance}.");

            return $payment;
        });
    }

    /**
     * Internal method to log activity and calculate score points.
     */
    protected function logActivity(Enquiry $enquiry, string $type, string $remarks): void
    {
        $employeeId = $enquiry->assigned_employee_id ?? Auth::id();
        $employee = \App\Models\User::find($employeeId);
        $teamId = $enquiry->assigned_team_id ?? ($employee ? $employee->team?->id : null);

        $score = $this->scoreService->getScoreForActivity($type);

        Activity::create([
            'enquiry_id' => $enquiry->id,
            'employee_id' => $employeeId,
            'team_id' => $teamId,
            'activity_type' => $type,
            'remarks' => $remarks,
            'score' => $score
        ]);

        // Cache total score on Enquiry
        $enquiry->total_score = $enquiry->activities()->sum('score');
        $enquiry->saveQuietly();
    }

    /**
     * Generate sequential enquiry number, e.g. SMEC-ENQ-2026-00001
     */
    protected function generateEnquiryNumber(): string
    {
        $year = date('Y');
        $latest = Enquiry::where('enquiry_number', 'like', "SMEC-ENQ-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latest) {
            $num = (int) substr($latest->enquiry_number, -5);
            $next = $num + 1;
        } else {
            $next = 1;
        }

        return 'SMEC-ENQ-' . $year . '-' . str_pad($next, 5, '0', STR_PAD_LEFT);
    }
}
