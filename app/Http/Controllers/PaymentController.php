<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Services\EnquiryService;

class PaymentController extends Controller
{
    protected $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->enquiryService = $enquiryService;
    }

    public function store(StorePaymentRequest $request, Enquiry $enquiry)
    {
        $this->enquiryService->addPayment($enquiry, $request->validated());

        return redirect()->route('enquiries.show', $enquiry->id)
            ->with('success', 'Payment details saved and admission status updated.');
    }
}
