<x-app-layout>
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Reports Center</h2>
        <p class="text-secondary small mb-0">Select, filter, and export performance audits, lead conversions, and team point logs.</p>
    </div>

    <div class="card glass-card border-0 p-4">
        <form action="{{ route('reports.generate') }}" method="GET">
            <div class="row g-3">
                <h5 class="fw-bold text-primary mb-1 col-12">1. Select Report Type</h5>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Report Category *</label>
                    <select name="report_type" class="form-select" required>
                        <option value="employee" selected>Performance Report of Employees</option>
                        <option value="team">Performance Report of Teams</option>
                        <option value="performance">Detailed Points Log</option>
                    </select>
                </div>

                <hr class="text-secondary opacity-25 my-4 col-12">
                <h5 class="fw-bold text-primary mb-1 col-12">2. Set Period Filters</h5>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Date Preset *</label>
                    <select name="date_preset" id="date_preset" class="form-select" required>
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="week">This Week</option>
                        <option value="month" selected>This Month</option>
                        <option value="year">This Year</option>
                        <option value="custom">Custom Date Range</option>
                    </select>
                </div>

                <div class="col-6 col-md-4 custom-date-group" style="display:none;">
                    <label class="form-label small fw-semibold">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>

                <div class="col-6 col-md-4 custom-date-group" style="display:none;">
                    <label class="form-label small fw-semibold">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>

                <hr class="text-secondary opacity-25 my-4 col-12">
                <h5 class="fw-bold text-primary mb-1 col-12">3. Additional Advanced Filters</h5>

                <div class="col-12 col-md-6">
                    <label class="form-label small fw-semibold">Course</label>
                    <select name="course_id" class="form-select">
                        <option value="">All Courses</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label small fw-semibold">Employee</label>
                    <select name="employee_id" class="form-select">
                        <option value="">All Employees</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 d-flex flex-column flex-lg-row justify-content-lg-end gap-2 border-top pt-4 mt-4">
                    <button type="submit" name="export_format" value="view" class="btn btn-primary px-4 py-2 fw-semibold w-100 w-lg-auto"><i class="bi bi-display me-1"></i> Generate View</button>
                    <button type="submit" name="export_format" value="pdf" class="btn btn-outline-danger px-4 py-2 fw-semibold w-100 w-lg-auto"><i class="bi bi-file-earmark-pdf me-1"></i> Download PDF</button>
                    <button type="submit" name="export_format" value="excel" class="btn btn-outline-success px-4 py-2 fw-semibold w-100 w-lg-auto"><i class="bi bi-file-earmark-excel me-1"></i> Download Excel</button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#date_preset').change(function() {
                if ($(this).val() === 'custom') {
                    $('.custom-date-group').slideDown();
                    $('#start_date, #end_date').prop('required', true);
                } else {
                    $('.custom-date-group').slideUp();
                    $('#start_date, #end_date').prop('required', false);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
