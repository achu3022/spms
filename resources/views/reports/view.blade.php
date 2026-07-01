<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <a href="{{ route('reports.index') }}" class="btn btn-light btn-rounded py-2 small fw-semibold mb-2"><i class="bi bi-arrow-left me-1"></i> Back to Report Center</a>
            <h2 class="fw-bold mb-1">{{ $data['report_title'] }}</h2>
            <p class="text-secondary small mb-0">Period: <strong class="text-primary">{{ date('M d, Y', strtotime($data['start_date'])) }}</strong> to <strong class="text-primary">{{ date('M d, Y', strtotime($data['end_date'])) }}</strong></p>
        </div>
        <div class="d-flex gap-2">
            <!-- Quick Export controls repeating the active params -->
            <form action="{{ route('reports.generate') }}" method="GET" class="d-flex gap-1">
                <input type="hidden" name="report_type" value="{{ $type }}">
                <input type="hidden" name="date_preset" value="{{ $preset }}">
                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                <input type="hidden" name="branch_id" value="{{ request('branch_id') }}">
                <input type="hidden" name="course_id" value="{{ request('course_id') }}">
                <input type="hidden" name="lead_source_id" value="{{ request('lead_source_id') }}">
                <input type="hidden" name="employee_id" value="{{ request('employee_id') }}">

                <button type="submit" name="export_format" value="excel" class="btn btn-success btn-rounded py-2 px-3 small fw-semibold"><i class="bi bi-file-earmark-excel"></i> Excel</button>
                <button type="submit" name="export_format" value="pdf" class="btn btn-danger btn-rounded py-2 px-3 small fw-semibold"><i class="bi bi-file-earmark-pdf"></i> PDF</button>
                <button type="submit" name="export_format" value="print" class="btn btn-dark btn-rounded py-2 px-3 small fw-semibold" target="_blank"><i class="bi bi-printer"></i> Print</button>
            </form>
        </div>
    </div>

    <!-- Embedded Table Card -->
    <div class="card glass-card border-0 p-4">
        @include($viewName, ['records' => $data['records']])
    </div>
</x-app-layout>
