<x-app-layout>
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
            <div>
                <h4 class="fw-bold mb-1"><i class="bi bi-graph-up text-primary me-2"></i> Performance Analytics</h4>
                <p class="text-secondary small mb-0">Track daily counts of Walk-ins, Registrations, Admissions, and Payments.</p>
            </div>
            <div class="mt-3 mt-md-0 d-flex gap-2">
                <a href="{{ route('admin.performance.export', request()->all()) }}" target="_blank" class="btn btn-outline-secondary rounded-pill px-3 shadow-sm">
                    <i class="bi bi-printer me-1"></i> Print / Export
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4">
                <form action="{{ route('admin.performance.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Date Range Preset</label>
                        <select name="date_preset" class="form-select form-select-sm" onchange="toggleCustomDates(this.value)">
                            <option value="today" {{ $preset == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="weekly" {{ $preset == 'weekly' ? 'selected' : '' }}>This Week</option>
                            <option value="monthly" {{ $preset == 'monthly' ? 'selected' : '' }}>This Month</option>
                            <option value="custom" {{ $preset == 'custom' ? 'selected' : '' }}>Custom Dates</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2 custom-date {{ $preset == 'custom' ? '' : 'd-none' }}">
                        <label class="form-label small fw-semibold">Start Date</label>
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ $start }}">
                    </div>
                    
                    <div class="col-md-2 custom-date {{ $preset == 'custom' ? '' : 'd-none' }}">
                        <label class="form-label small fw-semibold">End Date</label>
                        <input type="date" name="end_date" class="form-control form-control-sm" value="{{ $end }}">
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Employee</label>
                        <select name="employee_id" class="form-select form-select-sm">
                            <option value="">All Employees</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ $employeeId == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100 rounded-pill shadow-sm">
                            <i class="bi bi-filter me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-4">
            <!-- Admissions -->
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                        <i class="bi bi-person-check fs-1 text-success opacity-50 mb-2"></i>
                        <h2 class="fw-bold mb-0 text-success">{{ $admissions }}</h2>
                        <span class="text-secondary small fw-semibold text-uppercase">Admissions</span>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-success" style="height: 4px;"></div>
                </div>
            </div>
            
            <!-- Walk-ins -->
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                        <i class="bi bi-door-open fs-1 text-primary opacity-50 mb-2"></i>
                        <h2 class="fw-bold mb-0 text-primary">{{ $walkins }}</h2>
                        <span class="text-secondary small fw-semibold text-uppercase">Walk-ins</span>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
                </div>
            </div>
            
            <!-- Registrations -->
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                        <i class="bi bi-clipboard-check fs-1 text-info opacity-50 mb-2"></i>
                        <h2 class="fw-bold mb-0 text-info">{{ $registrations }}</h2>
                        <span class="text-secondary small fw-semibold text-uppercase">Registrations</span>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-info" style="height: 4px;"></div>
                </div>
            </div>
            
            <!-- Payments -->
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center p-4">
                        <i class="bi bi-cash-coin fs-1 text-warning opacity-50 mb-2"></i>
                        <h2 class="fw-bold mb-0 text-warning">{{ $payments }}</h2>
                        <span class="text-secondary small fw-semibold text-uppercase">Full Payments</span>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 bg-warning" style="height: 4px;"></div>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white border-bottom p-4">
                <h6 class="fw-bold mb-0">Detailed Performance Records</h6>
                <small class="text-muted">Showing records for {{ ucwords(str_replace('_', ' ', $preset)) }} period</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Date</th>
                                <th>Employee</th>
                                <th class="text-center">Walk-ins</th>
                                <th class="text-center">Registrations</th>
                                <th class="text-center">Admissions</th>
                                <th class="text-center pe-4">Full Payments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-medium">{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($record->user?->employeeProfile?->photo)
                                                <img src="{{ asset('storage/' . $record->user->employeeProfile->photo) }}" class="rounded-circle object-fit-cover" width="30" height="30" alt="">
                                            @else
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.7rem;">
                                                    {{ strtoupper(substr($record->user?->name ?? 'Unknown', 0, 2)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold small">{{ $record->user?->name ?? 'Unknown' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold text-primary">
                                        {{ $record->walkins }}
                                    </td>
                                    <td class="text-center fw-bold text-info">
                                        {{ $record->registrations }}
                                    </td>
                                    <td class="text-center fw-bold text-success">
                                        {{ $record->admissions }}
                                    </td>
                                    <td class="text-center pe-4 fw-bold text-warning">
                                        {{ $record->payments }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleCustomDates(val) {
            const dateFields = document.querySelectorAll('.custom-date');
            if (val === 'custom') {
                dateFields.forEach(el => el.classList.remove('d-none'));
            } else {
                dateFields.forEach(el => el.classList.add('d-none'));
            }
        }
    </script>
    @endpush
</x-app-layout>
