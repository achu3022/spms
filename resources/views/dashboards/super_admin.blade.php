<x-app-layout>
    <!-- Main Dashboard Container -->
    <div style="background-color: #f7f8fc; min-height: calc(100vh - 60px); margin: -1.5rem; padding: 1.5rem; font-family: 'Inter', sans-serif;">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold mb-1 text-dark">Dashboard</h3>
                <p class="text-secondary small mb-0">Welcome back! Here are today's reports for SMEC Labs</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <span class="text-muted small fw-bold"><i class="bi bi-calendar-event me-1"></i> {{ now()->format('F Y') }}</span>
            </div>
        </div>

        <!-- Top Widgets Row (Combined Card) -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h5 class="fw-bold mb-0 text-dark">Performance & Info</h5>
                <span class="text-muted small fw-semibold">This Month <i class="bi bi-chevron-down"></i></span>
            </div>
            <div class="row text-center">
                <!-- Stat 1 -->
                <div class="col-6 col-md-3 border-end">
                    <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-3" style="width: 40px; height: 40px;">
                        <i class="bi bi-star-fill fs-5"></i>
                    </div>
                    <div class="fs-4 fw-bolder text-dark mb-1">{{ $monthly_score }}</div>
                    <div class="text-secondary small fw-semibold mb-2">Monthly Score</div>
                    <div class="text-success small fw-bold">
                        <i class="bi bi-arrow-up-short"></i> Active
                    </div>
                </div>
                <!-- Stat 2 -->
                <div class="col-6 col-md-3 border-end">
                    <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle mb-3" style="width: 40px; height: 40px;">
                        <i class="bi bi-graph-up-arrow fs-5"></i>
                    </div>
                    <div class="fs-4 fw-bolder text-dark mb-1">{{ $overall_admissions ?? 0 }}</div>
                    <div class="text-secondary small fw-semibold mb-2">Overall Admissions</div>
                    <div class="text-success small fw-bold">
                        <i class="bi bi-arrow-up-right"></i> Stable
                    </div>
                </div>
                <!-- Stat 3 -->
                <div class="col-6 col-md-3 border-end">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-circle mb-3" style="width: 40px; height: 40px;">
                        <i class="bi bi-lightning-charge-fill fs-5"></i>
                    </div>
                    <div class="fs-4 fw-bolder text-dark mb-1">{{ $monthly_growth >= 0 ? '+' : '' }}{{ $monthly_growth }}%</div>
                    <div class="text-secondary small fw-semibold mb-2">Monthly Growth</div>
                    <div class="{{ $monthly_growth >= 0 ? 'text-success' : 'text-danger' }} small fw-bold">
                        <i class="bi {{ $monthly_growth >= 0 ? 'bi-arrow-up-right' : 'bi-arrow-down-right' }}"></i> {{ $monthly_growth >= 0 ? 'Up' : 'Down' }}
                    </div>
                </div>
                <!-- Stat 4 -->
                <div class="col-6 col-md-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-info bg-opacity-10 text-info rounded-circle mb-3" style="width: 40px; height: 40px;">
                        <i class="bi bi-check2-circle fs-5"></i>
                    </div>
                    <div class="fs-4 fw-bolder text-dark mb-1">{{ $today_score }}</div>
                    <div class="text-secondary small fw-semibold mb-2">Today's Score</div>
                    <div class="text-success small fw-bold">
                        <i class="bi bi-arrow-up-right"></i> 3.7%
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Row -->
        <div class="row g-4 mb-4">
            <!-- Left Chart -->
            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex gap-4">
                            <span class="fw-bold text-dark border-bottom border-warning border-3 pb-1">Walk-ins</span>
                            <span class="fw-bold text-secondary">Registrations</span>
                            <span class="fw-bold text-secondary">Admissions</span>
                        </div>
                        <div class="d-flex gap-3 text-muted small fw-semibold">
                            <span><i class="bi bi-circle-fill text-warning me-1"></i> Walk-ins</span>
                            <span><i class="bi bi-circle-fill text-danger me-1"></i> Admissions</span>
                        </div>
                    </div>
                    <div style="height: 300px; width: 100%;">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Gauge/Info -->
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white text-center">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-bold text-dark m-0">Top Performers</h6>
                        <span class="text-muted small fw-semibold">This Month <i class="bi bi-chevron-down"></i></span>
                    </div>

                    <!-- Top Team -->
                    <div class="p-3 bg-light rounded-4 mb-3 border-0 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="text-start">
                                <div class="fw-bold text-dark">{{ $top_team ? $top_team->name : 'N/A' }}</div>
                                <div class="small text-secondary fw-semibold">Top Team</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">{{ $top_team ? $top_team->score : 0 }} Pts</span>
                        </div>
                    </div>

                    <!-- Top Employee -->
                    <div class="p-3 bg-light rounded-4 mb-3 border-0 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            @if($top_employee && $top_employee->photo)
                                <img src="{{ asset('storage/' . $top_employee->photo) }}" width="45" height="45" class="rounded-circle object-fit-cover shadow-sm">
                            @else
                                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                            <div class="text-start">
                                <div class="fw-bold text-dark">{{ $top_employee ? $top_employee->name : 'N/A' }}</div>
                                <div class="small text-secondary fw-semibold">{{ $top_employee ? $top_employee->designation : 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">{{ $top_employee ? $top_employee->score : 0 }} Pts</span>
                        </div>
                    </div>

                    <a href="{{ route('leaderboard') }}" class="btn btn-warning text-white rounded-pill w-100 py-2 fw-bold mt-3 shadow-sm" style="background: linear-gradient(90deg, #ff8a00, #e52e71); border: none;">View Full Leaderboard</a>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="row g-4">
            <!-- System Resources -->
            <div class="col-12 col-xl-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <h6 class="fw-bold text-dark m-0">System Resources & Organization</h6>
                        <span class="text-warning small fw-bold">View All <i class="bi bi-chevron-double-right"></i></span>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="text-muted small fw-semibold uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                <tr>
                                    <th>RESOURCE</th>
                                    <th>METRIC</th>
                                    <th>STATUS</th>
                                    <th>DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">Registered Employees</td>
                                    <td class="text-primary fw-bold">{{ $total_employees }}</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">Active</span></td>
                                    <td class="text-muted small">{{ now()->format('d M, Y') }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">Active Teams</td>
                                    <td class="text-warning fw-bold">{{ $total_teams }}</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">Active</span></td>
                                    <td class="text-muted small">{{ now()->format('d M, Y') }}</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="fw-bold text-dark">Active Branches</td>
                                    <td class="text-info fw-bold">{{ $active_branches ?? 0 }}</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">Active</span></td>
                                    <td class="text-muted small">{{ now()->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-dark">Active Courses</td>
                                    <td class="text-danger fw-bold">{{ $active_courses ?? 0 }}</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2">Active</span></td>
                                    <td class="text-muted small">{{ now()->format('d M, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="col-12 col-xl-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                        <h6 class="fw-bold text-dark m-0">Recent Activity</h6>
                        <span class="text-warning small fw-bold">View All <i class="bi bi-chevron-double-right"></i></span>
                    </div>

                    <div class="d-flex gap-3 mb-4 border-bottom pb-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark">Today's Total Payments <span class="text-muted small ms-2">• {{ now()->diffForHumans() }}</span></div>
                            <div class="small text-secondary mt-1">Total recorded payments across the organization today.</div>
                            <div class="fw-bolder text-dark mt-2 fs-5">{{ $today_payments }}</div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-muted" style="width: 40px; height: 40px;">
                            <i class="bi bi-funnel"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark">Overall Walk-ins <span class="text-muted small ms-2">• Lifetime</span></div>
                            <div class="small text-secondary mt-1">Total walk-ins recorded in the system.</div>
                            <div class="fw-bolder text-dark mt-2 fs-5">{{ $overall_walkins ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const ctx = document.getElementById('performanceChart').getContext('2d');
        
        // Gradients
        let gradientOrange = ctx.createLinearGradient(0, 0, 0, 300);
        gradientOrange.addColorStop(0, 'rgba(255, 138, 0, 0.2)');
        gradientOrange.addColorStop(1, 'rgba(255, 138, 0, 0)');

        let gradientPink = ctx.createLinearGradient(0, 0, 0, 300);
        gradientPink.addColorStop(0, 'rgba(229, 46, 113, 0.2)');
        gradientPink.addColorStop(1, 'rgba(229, 46, 113, 0)');

        let gradientBlue = ctx.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(0, 112, 188, 0.1)');
        gradientBlue.addColorStop(1, 'rgba(0, 112, 188, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_days) !!},
                datasets: [
                    {
                        label: 'Walk-ins',
                        data: {!! json_encode($chart_walkins) !!},
                        borderColor: '#ff8a00',
                        backgroundColor: gradientOrange,
                        borderWidth: 3,
                        pointBackgroundColor: '#ff8a00',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4 // Smooth curve
                    },
                    {
                        label: 'Registrations',
                        data: {!! json_encode($chart_registrations) !!},
                        borderColor: '#0070bc',
                        backgroundColor: gradientBlue,
                        borderWidth: 2,
                        pointRadius: 0,
                        fill: true,
                        tension: 0.4 // Smooth curve
                    },
                    {
                        label: 'Admissions',
                        data: {!! json_encode($chart_admissions) !!},
                        borderColor: '#e52e71',
                        backgroundColor: gradientPink,
                        borderWidth: 3,
                        pointBackgroundColor: '#e52e71',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        fill: true,
                        tension: 0.4 // Smooth curve
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false // Hide default legend as per design
                    },
                    tooltip: {
                        backgroundColor: '#1a1a1a',
                        titleFont: { size: 13 },
                        bodyFont: { size: 13, weight: 'bold' },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f0f0f0',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#a0a0a0',
                            font: { size: 11, weight: '600' }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#a0a0a0',
                            font: { size: 11, weight: '600' }
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
