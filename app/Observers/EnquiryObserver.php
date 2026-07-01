<?php

namespace App\Observers;

use App\Models\Enquiry;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class EnquiryObserver
{
    public function created(Enquiry $enquiry): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'create',
            'model_type' => Enquiry::class,
            'model_id' => $enquiry->id,
            'description' => "Created enquiry #{$enquiry->enquiry_number} for {$enquiry->student_name}.",
            'new_values' => $enquiry->toArray(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public function updated(Enquiry $enquiry): void
    {
        $dirty = $enquiry->getDirty();
        $old = [];
        $new = [];

        foreach ($dirty as $key => $value) {
            $old[$key] = $enquiry->getOriginal($key);
            $new[$key] = $value;
        }

        // Avoid logging total_score updates or timestamps unless they are the only changes
        if (count($dirty) === 1 && (array_key_exists('total_score', $dirty) || array_key_exists('updated_at', $dirty))) {
            return;
        }

        $desc = "Updated enquiry #{$enquiry->enquiry_number} for {$enquiry->student_name}.";
        if (array_key_exists('current_status', $dirty)) {
            $oldStatus = $enquiry->getOriginal('current_status');
            $newStatus = $enquiry->current_status;
            $desc .= " Status changed from '{$oldStatus}' to '{$newStatus}'.";
        }
        
        if (array_key_exists('assigned_employee_id', $dirty)) {
            $desc .= " Transferred / re-assigned to employee ID {$enquiry->assigned_employee_id}.";
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'update',
            'model_type' => Enquiry::class,
            'model_id' => $enquiry->id,
            'description' => $desc,
            'old_values' => $old,
            'new_values' => $new,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    public function deleted(Enquiry $enquiry): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete',
            'model_type' => Enquiry::class,
            'model_id' => $enquiry->id,
            'description' => "Deleted enquiry #{$enquiry->enquiry_number} for {$enquiry->student_name}.",
            'old_values' => $enquiry->toArray(),
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}
