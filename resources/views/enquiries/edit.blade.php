<x-app-layout>
    <div class="mb-4">
        <a href="{{ route('enquiries.show', $enquiry->id) }}" class="btn btn-light btn-rounded py-2 small fw-semibold mb-2"><i class="bi bi-arrow-left me-1"></i> Back to Enquiry Details</a>
        <h2 class="fw-bold mb-1">Edit Student Enquiry: #{{ $enquiry->enquiry_number }}</h2>
        <p class="text-secondary small mb-0">Modify demographic details, status transitions, or remarks for <strong class="text-primary">{{ $enquiry->student_name }}</strong>.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-2">Please correct the following errors:</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card glass-card border-0 p-4 mb-4">
        <form action="{{ route('enquiries.update', $enquiry->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row g-3">
                <h5 class="fw-bold text-primary mb-1 col-12">1. Personal Information</h5>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Student Name *</label>
                    <input type="text" name="student_name" class="form-control" value="{{ old('student_name', $enquiry->student_name) }}" required placeholder="e.g. John Doe">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Mobile Number *</label>
                    <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $enquiry->phone_number) }}" required placeholder="10-digit mobile phone">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $enquiry->whatsapp_number) }}" placeholder="WhatsApp contact">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Parent Phone</label>
                    <input type="text" name="parent_phone" class="form-control" value="{{ old('parent_phone', $enquiry->parent_phone) }}" placeholder="Emergency parent number">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $enquiry->email) }}" placeholder="student@example.com">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $enquiry->gender) === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $enquiry->gender) === 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $enquiry->gender) === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Educational Qualification</label>
                    <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $enquiry->qualification) }}" placeholder="Degree / Diploma">
                </div>

                <hr class="text-secondary opacity-25 my-4 col-12">
                <h5 class="fw-bold text-primary mb-1 col-12">2. Location Information</h5>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Place / Location</label>
                    <input type="text" name="place" class="form-control" value="{{ old('place', $enquiry->place) }}" placeholder="City/Village">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">State</label>
                    <select name="state_id" id="state_select" class="form-select">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}" {{ old('state_id', $enquiry->state_id) == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">District</label>
                    <select name="district_id" id="district_select" class="form-select" disabled>
                        <option value="">Select State First</option>
                    </select>
                </div>

                <hr class="text-secondary opacity-25 my-4 col-12">
                <h5 class="fw-bold text-primary mb-1 col-12">3. Course Registration & Status</h5>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Course Interested *</label>
                    <select name="course_id" class="form-select" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ old('course_id', $enquiry->course_id) == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->code }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Branch *</label>
                    <select name="branch_id" class="form-select" required>
                        <option value="">Select Branch</option>
                        @foreach($branches as $b)
                            <option value="{{ $b->id }}" {{ old('branch_id', $enquiry->branch_id) == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Lead Source *</label>
                    <select name="lead_source_id" class="form-select" required>
                        <option value="">Select Source</option>
                        @foreach($leadSources as $ls)
                            <option value="{{ $ls->id }}" {{ old('lead_source_id', $enquiry->lead_source_id) == $ls->id ? 'selected' : '' }}>{{ $ls->name }}</option>
                        @endforeach
                    </select>
                </div>

                @role('Super Admin|Sales Head (HOD)')
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Assign Employee (Sales Executive)</label>
                    <select name="assigned_employee_id" class="form-select">
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('assigned_employee_id', $enquiry->assigned_employee_id) == $emp->id ? 'selected' : '' }}>{{ $emp->name }} ({{ $emp->roles->first()?->name }})</option>
                        @endforeach
                    </select>
                </div>
                @endrole

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Current Enquiry Status *</label>
                    <select name="current_status" class="form-select" required>
                        <option value="New" {{ old('current_status', $enquiry->current_status) === 'New' ? 'selected' : '' }}>New Enquiry</option>
                        <option value="Walk-in" {{ old('current_status', $enquiry->current_status) === 'Walk-in' ? 'selected' : '' }}>Walk-in Visit</option>
                        <option value="Registered" {{ old('current_status', $enquiry->current_status) === 'Registered' ? 'selected' : '' }}>Registered</option>
                        <option value="Admitted" {{ old('current_status', $enquiry->current_status) === 'Admitted' ? 'selected' : '' }}>Admitted</option>
                        <option value="Full Payment" {{ old('current_status', $enquiry->current_status) === 'Full Payment' ? 'selected' : '' }}>Full Payment</option>
                        <option value="Follow-up" {{ old('current_status', $enquiry->current_status) === 'Follow-up' ? 'selected' : '' }}>Follow-up Callback</option>
                        <option value="Lost" {{ old('current_status', $enquiry->current_status) === 'Lost' ? 'selected' : '' }}>Lost</option>
                        <option value="Cancelled" {{ old('current_status', $enquiry->current_status) === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label small fw-semibold">Internal Notes / Status Update Remarks</label>
                    <textarea name="remarks" class="form-control" rows="4" placeholder="Enter conversation points, preferences, follow-up callbacks here...">{{ old('remarks', $enquiry->remarks) }}</textarea>
                </div>

                <div class="col-12 d-flex gap-2 justify-content-end mt-4">
                    <a href="{{ route('enquiries.show', $enquiry->id) }}" class="btn btn-outline-secondary btn-rounded px-4 py-2 small fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-rounded px-4 py-2 small fw-semibold"><i class="bi bi-save me-1"></i> Save Changes</button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Check state on load
            const initialScaleId = $('#state_select').val();
            if (initialScaleId) {
                loadDistricts(initialScaleId, "{{ old('district_id', $enquiry->district_id) }}");
            }

            $('#state_select').change(function() {
                const stateId = $(this).val();
                loadDistricts(stateId, null);
            });

            function loadDistricts(stateId, selectedDistrictId) {
                const $districtSelect = $('#district_select');
                if (!stateId) {
                    $districtSelect.empty().append('<option value="">Select State First</option>').prop('disabled', true);
                    return;
                }

                $districtSelect.prop('disabled', true).empty().append('<option>Loading districts...</option>');

                $.ajax({
                    url: `/enquiries/districts/${stateId}`,
                    method: 'GET',
                    success: function(data) {
                        $districtSelect.empty().append('<option value="">Select District</option>');
                        data.forEach(function(district) {
                            const isSelected = selectedDistrictId == district.id ? 'selected' : '';
                            $districtSelect.append(`<option value="${district.id}" ${isSelected}>${district.name}</option>`);
                        });
                        $districtSelect.prop('disabled', false);
                    },
                    error: function() {
                        $districtSelect.empty().append('<option>Failed to load districts</option>');
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
