<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Super Admin Dashboard</h2>
            <p class="text-secondary small mb-0">Overview of SMEC Labs sales activities, employee scores, and performance metrics.</p>
        </div>
        <div class="d-flex gap-2">
            <span class="badge bg-primary px-3 py-2 btn-rounded fs-7">Active Month: {{ now()->format('F Y') }}</span>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="row g-3 mb-4">
        <!-- Card 1: Today's Enquiries -->
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="text-secondary font-monospace small">TODAY'S ENQUIRIES</div>
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-circle p-2"><i class="bi bi-person-plus-fill"></i></span>
                </div>
                <div class="fs-2 fw-bold">{{ $today_enquiries }}</div>
                <div class="text-muted small mt-1">Real-time leads entered</div>
            </div>
        </div>

        <!-- Card 2: Today's Walk-ins -->
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="text-secondary font-monospace small">TODAY'S WALK-INS</div>
                    <span class="badge bg-warning bg-opacity-10 text-warning rounded-circle p-2"><i class="bi bi-geo-alt-fill"></i></span>
                </div>
                <div class="fs-2 fw-bold">{{ $today_walkins }}</div>
                <div class="text-muted small mt-1">1 Point awarded per lead</div>
            </div>
        </div>

        <!-- Card 3: Today's Registrations -->
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="text-secondary font-monospace small">TODAY'S REGISTRATIONS</div>
                    <span class="badge bg-info bg-opacity-10 text-info rounded-circle p-2"><i class="bi bi-journal-check"></i></span>
                </div>
                <div class="fs-2 fw-bold">{{ $today_registrations }}</div>
                <div class="text-muted small mt-1">1 Point awarded per lead</div>
            </div>
        </div>

        <!-- Card 4: Today's Admissions -->
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="text-secondary font-monospace small">TODAY'S ADMISSIONS</div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-circle p-2"><i class="bi bi-award-fill"></i></span>
                </div>
                <div class="fs-2 fw-bold">{{ $today_admissions }}</div>
                <div class="text-muted small mt-1">4 Points awarded per lead</div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Area -->
    <div class="row g-4 mb-4">
        <!-- Column 1: Core Performance Metrics -->
        <div class="col-12 col-lg-8">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3">Daily Performance Trend</h5>
                <div style="height: 320px;">
                    <canvas id="performanceChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Column 2: Leaderboard Snippet -->
        <div class="col-12 col-lg-4">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3">Top Performers</h5>
                
                <!-- Top Team -->
                <div class="p-3 bg-light rounded-4 mb-3 border d-flex align-items-center justify-content-between dark-card bg-opacity-50">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fs-3">🏆</span>
                        <div>
                            <div class="small text-secondary">TOP TEAM THIS MONTH</div>
                            <div class="fw-bold">{{ $top_team ? $top_team->name : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary px-3 py-2 btn-rounded">{{ $top_team ? $top_team->score : 0 }} Pts</span>
                    </div>
                </div>

                <!-- Top Employee -->
                <div class="p-3 bg-light rounded-4 mb-3 border d-flex align-items-center justify-content-between dark-card bg-opacity-50">
                    <div class="d-flex align-items-center gap-3">
                        @if($top_employee && $top_employee->photo)
                            <img src="{{ asset('storage/' . $top_employee->photo) }}" width="45" height="45" class="rounded-circle object-fit-cover">
                        @else
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                👤
                            </div>
                        @endif
                        <div>
                            <div class="small text-secondary">TOP EXECUTIVE THIS MONTH</div>
                            <div class="fw-bold">{{ $top_employee ? $top_employee->name : 'N/A' }}</div>
                            <div class="small text-muted">{{ $top_employee ? $top_employee->designation : 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-success px-3 py-2 btn-rounded">{{ $top_employee ? $top_employee->score : 0 }} Pts</span>
                    </div>
                </div>

                <div class="row g-2 text-center">
                    <div class="col-6">
                        <div class="p-2 border rounded-3 bg-white dark-card">
                            <div class="small text-secondary">TODAY'S SCORE</div>
                            <div class="fs-4 fw-bold text-primary">{{ $today_score }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded-3 bg-white dark-card">
                            <div class="small text-secondary">MONTHLY SCORE</div>
                            <div class="fs-4 fw-bold text-success">{{ $monthly_score }}</div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="{{ route('leaderboard') }}" class="btn btn-outline-primary btn-rounded w-100 py-2 small fw-semibold">View Leaderboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Extra Row: System Summary & Other Stats -->
    <div class="row g-4">
        <!-- System Summary Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3">System Resources</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span>Total Registered Employees</span>
                        <span class="badge bg-secondary rounded-pill">{{ $total_employees }}</span>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span>Total Active Teams</span>
                        <span class="badge bg-secondary rounded-pill">{{ $total_teams }}</span>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span>Today's Total Payments</span>
                        <span class="badge bg-secondary rounded-pill">{{ $today_payments }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Organization Assets Card -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3">Organization Setup</h5>
                <div class="list-group list-group-flush">
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span>Active Branches</span>
                        <span class="badge bg-info rounded-pill">{{ $active_branches ?? 0 }}</span>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span>Active Courses</span>
                        <span class="badge bg-info rounded-pill">{{ $active_courses ?? 0 }}</span>
                    </div>
                    <div class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span>Active Lead Sources</span>
                        <span class="badge bg-info rounded-pill">{{ $active_lead_sources ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Snapshot Card -->
        <div class="col-12 col-lg-4">
            <div class="card glass-card border-0 p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold m-0">Performance Snapshot</h5>
                    <span class="fs-3">📈</span>
                </div>
                <div class="d-flex flex-column gap-3 mt-2">
                    <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light dark-card">
                        <span class="text-secondary small fw-bold">OVERALL WALK-INS</span>
                        <span class="fw-bold fs-5 text-primary">{{ $overall_walkins ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light dark-card">
                        <span class="text-secondary small fw-bold">OVERALL ADMISSIONS</span>
                        <span class="fw-bold fs-5 text-success">{{ $overall_admissions ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_days) !!},
                datasets: [
                    {
                        label: 'Walk-ins',
                        data: {!! json_encode($chart_walkins) !!},
                        borderColor: '#00AA9E',
                        backgroundColor: 'rgba(0, 170, 158, 0.1)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Registrations',
                        data: {!! json_encode($chart_registrations) !!},
                        borderColor: '#0070BC',
                        backgroundColor: 'rgba(0, 112, 188, 0.1)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Admissions',
                        data: {!! json_encode($chart_admissions) !!},
                        borderColor: '#2D318F',
                        backgroundColor: 'rgba(45, 49, 143, 0.1)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
