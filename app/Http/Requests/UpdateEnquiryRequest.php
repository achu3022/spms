<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $enquiryId = $this->route('enquiry') ? $this->route('enquiry')->id : null;
        
        return [
            'student_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20|unique:enquiries,phone_number,' . $enquiryId,
            'whatsapp_number' => 'nullable|string|max:20',
            'parent_phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'place' => 'nullable|string|max:255',
            'district_id' => 'nullable|exists:districts,id',
            'state_id' => 'nullable|exists:states,id',
            'qualification' => 'nullable|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'branch_id' => 'required|exists:branches,id',
            'lead_source_id' => 'required|exists:lead_sources,id',
            'remarks' => 'nullable|string',
            'assigned_employee_id' => 'nullable|exists:users,id',
            'current_status' => 'required|string|in:New,Walk-in,Registered,Admitted,Full Payment,Follow-up,Lost,Cancelled',
        ];
    }
}
