<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFollowUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'follow_up_date' => 'required|date',
            'follow_up_time' => 'nullable',
            'remarks' => 'required|string',
            'next_follow_up_date' => 'nullable|date|after_or_equal:follow_up_date',
            'next_follow_up_time' => 'nullable',
            'status' => 'required|string|in:Pending,Completed,No Response,Postponed',
        ];
    }
}
