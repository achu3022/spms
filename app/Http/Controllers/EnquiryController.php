<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnquiryRequest;
use App\Http\Requests\UpdateEnquiryRequest;
use App\Models\Enquiry;
use App\Models\Branch;
use App\Models\Course;
use App\Models\LeadSource;
use App\Models\State;
use App\Models\District;
use App\Models\User;
use App\Repositories\EnquiryRepositoryInterface;
use App\Services\EnquiryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnquiryController extends Controller
{
    protected $enquiryRepository;
    protected $enquiryService;

    public function __construct(
        EnquiryRepositoryInterface $enquiryRepository,
        EnquiryService $enquiryService
    ) {
        $this->enquiryRepository = $enquiryRepository;
        $this->enquiryService = $enquiryService;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'branch_id', 'course_id', 'lead_source_id',
            'state_id', 'district_id', 'assigned_employee_id',
            'assigned_team_id', 'current_status', 'date_preset',
            'start_date', 'end_date'
        ]);

        // Access enforcement: Team Leader only views their own team. Executive only views their own enquiries.
        $user = Auth::user();
        if ($user->hasRole('Sales Executive')) {
            $filters['assigned_employee_id'] = $user->id;
        } elseif ($user->hasRole('Team Leader') || $user->hasRole('Vice Team Leader')) {
            if ($user->team) {
                $filters['assigned_team_id'] = $user->team->id;
            } else {
                // If not in a team, restrict to self
                $filters['assigned_employee_id'] = $user->id;
            }
        }

        $enquiries = $this->enquiryRepository->paginate(15, $filters);
        
        $branches = Branch::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $leadSources = LeadSource::where('status', 'active')->get();
        $employees = User::all();

        return view('enquiries.index', compact('enquiries', 'branches', 'courses', 'leadSources', 'employees'));
    }

    public function create()
    {
        $branches = Branch::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $leadSources = LeadSource::where('status', 'active')->get();
        $states = State::all();
        $employees = User::all();

        return view('enquiries.create', compact('branches', 'courses', 'leadSources', 'states', 'employees'));
    }

    public function store(StoreEnquiryRequest $request)
    {
        // Prevent duplicate mobile numbers
        $existing = $this->enquiryRepository->findByPhone($request->phone_number);
        if ($existing) {
            return redirect()->route('enquiries.edit', $existing->id)
                ->with('warning', "Duplicate mobile number detected! You have been redirected to update the existing record of '{$existing->student_name}'.");
        }

        $enquiry = $this->enquiryService->createEnquiry($request->validated());

        return redirect()->route('enquiries.show', $enquiry->id)
            ->with('success', "Enquiry #{$enquiry->enquiry_number} created successfully.");
    }

    public function show(Enquiry $enquiry)
    {
        // Check view policy / permission logic
        $user = Auth::user();
        if ($user->hasRole('Sales Executive') && $enquiry->assigned_employee_id !== $user->id) {
            abort(403, 'Unauthorized access to this enquiry.');
        }
        if (($user->hasRole('Team Leader') || $user->hasRole('Vice Team Leader')) && $user->team && $enquiry->assigned_team_id !== $user->team->id) {
            abort(403, 'Unauthorized access to this team enquiry.');
        }

        // Fetch related models with details
        $enquiry->load(['activities.employee', 'followUps.employee', 'payments.employee', 'branch', 'course', 'district', 'state']);

        return view('enquiries.show', compact('enquiry'));
    }

    public function edit(Enquiry $enquiry)
    {
        $user = Auth::user();
        if ($user->hasRole('Sales Executive') && $enquiry->assigned_employee_id !== $user->id) {
            abort(403, 'Unauthorized edit access.');
        }

        $branches = Branch::where('status', 'active')->get();
        $courses = Course::where('status', 'active')->get();
        $leadSources = LeadSource::where('status', 'active')->get();
        $states = State::all();
        $districts = District::where('state_id', $enquiry->state_id)->get();
        $employees = User::all();

        return view('enquiries.edit', compact('enquiry', 'branches', 'courses', 'leadSources', 'states', 'districts', 'employees'));
    }

    public function update(UpdateEnquiryRequest $request, Enquiry $enquiry)
    {
        $user = Auth::user();
        if ($user->hasRole('Sales Executive') && $enquiry->assigned_employee_id !== $user->id) {
            abort(403, 'Unauthorized update access.');
        }

        $this->enquiryService->updateEnquiry($enquiry, $request->validated());

        return redirect()->route('enquiries.show', $enquiry->id)
            ->with('success', 'Enquiry updated successfully.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole(['Super Admin', 'Sales Head (HOD)'])) {
            abort(403, 'Only administrators can delete records.');
        }

        $this->enquiryRepository->delete($enquiry);

        return redirect()->route('enquiries.index')
            ->with('success', 'Enquiry record deleted.');
    }

    /**
     * AJAX endpoint to fetch districts of a state dynamically.
     */
    public function getDistricts($stateId)
    {
        $districts = District::where('state_id', $stateId)->get();
        return response()->json($districts);
    }
}
