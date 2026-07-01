<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'admission_amount' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'scholarship' => 'nullable|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'balance' => 'required|numeric|min:0',
            'payment_mode' => 'required|string|in:Cash,Card,UPI,NetBanking,Cheque',
            'transaction_number' => 'nullable|string|max:255',
            'receipt_number' => 'required|string|max:255',
        ];
    }
}
