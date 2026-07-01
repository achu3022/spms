<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFollowUpRequest;
use App\Models\Enquiry;
use App\Models\FollowUp;
use App\Services\EnquiryService;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    protected $enquiryService;

    public function __construct(EnquiryService $enquiryService)
    {
        $this->enquiryService = $enquiryService;
    }

    public function store(StoreFollowUpRequest $request, Enquiry $enquiry)
    {
        $this->enquiryService->addFollowUp($enquiry, $request->validated());

        return redirect()->route('enquiries.show', $enquiry->id)
            ->with('success', 'Follow-up logged successfully and status updated.');
    }
}
