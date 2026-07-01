<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Sales Head Dashboard</h2>
            <p class="text-secondary small mb-0">HOD overview of team structures, conversion rates, and monthly leaderboards.</p>
        </div>
        <div>
            <span class="badge bg-primary px-3 py-2 btn-rounded fs-7 shadow-sm">Active Month: {{ now()->format('F Y') }}</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100 position-relative overflow-hidden card-hover">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-secondary font-monospace small">TOTAL ENQUIRIES</div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-person-fill-add"></i>
                    </div>
                </div>
                <div class="fs-2 fw-bold text-primary">{{ $overall_enquiries }}</div>
                <div class="text-secondary small mt-1"><i class="bi bi-clock-history me-1"></i>Cumulative database</div>
            </div>
        </div>
        
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100 position-relative overflow-hidden card-hover">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-secondary font-monospace small">TOTAL ADMISSIONS</div>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-award-fill"></i>
                    </div>
                </div>
                <div class="fs-2 fw-bold text-success">{{ $overall_admissions }}</div>
                <div class="text-secondary small mt-1"><i class="bi bi-check-circle-fill text-success me-1"></i>Admitted leads</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100 position-relative overflow-hidden card-hover">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-secondary font-monospace small">CONVERSION RATIO</div>
                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>
                <div class="fs-2 fw-bold text-info">{{ $conversion_ratio }}%</div>
                <div class="text-secondary small mt-1"><i class="bi bi-arrow-right-short text-info me-1"></i>Lead to conversion rate</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100 position-relative overflow-hidden card-hover">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-secondary font-monospace small">MONTHLY GROWTH</div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                </div>
                <div class="fs-2 fw-bold {{ $monthly_growth >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ $monthly_growth >= 0 ? '+' : '' }}{{ $monthly_growth }}%
                </div>
                <div class="text-secondary small mt-1">
                    <i class="bi {{ $monthly_growth >= 0 ? 'bi-caret-up-fill text-success' : 'bi-caret-down-fill text-danger' }} me-1"></i>vs Last Month Score
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Daily Activities Chart -->
        <div class="col-12 col-xl-8">
            <div class="card glass-card border-0 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold m-0"><i class="bi bi-activity text-primary me-2"></i>Daily Lead Conversion Trends</h5>
                    <div class="small text-secondary">Last 7 Days</div>
                </div>
                <div style="height: 330px; position: relative;">
                    <canvas id="hodDailyTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Conversion Breakdown -->
        <div class="col-12 col-xl-4">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3"><i class="bi bi-pie-chart-fill text-accent me-2"></i>Lead Status Proportions</h5>
                <div style="height: 250px; position: relative;" class="d-flex align-items-center justify-content-center">
                    <canvas id="hodStatusBreakdownChart"></canvas>
                </div>
                <div class="row text-center mt-3 g-2">
                    <div class="col-6">
                        <div class="small fw-semibold text-success">Admissions</div>
                        <div class="small font-monospace">{{ $overall_admissions }}</div>
                    </div>
                    <div class="col-6">
                        <div class="small fw-semibold text-primary">Total Leads</div>
                        <div class="small font-monospace">{{ $overall_enquiries }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaderboards Row -->
    <div class="row g-4 mb-4">
        <!-- Employee Leaderboard -->
        <div class="col-12 col-lg-6">
            <div class="card glass-card border-0 p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold m-0"><i class="bi bi-trophy text-warning me-2"></i>Top Performing Executives</h5>
                    <i class="bi bi-person-fill text-primary fs-4"></i>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Team</th>
                                <th class="text-end">Monthly Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employee_leaderboard as $idx => $emp)
                                <tr>
                                    <td>
                                        @if($emp->photo)
                                            <img src="{{ asset('storage/' . $emp->photo) }}" width="38" height="38" class="rounded-circle object-fit-cover">
                                        @else
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px; font-size: 0.85rem;">
                                                {{ strtoupper(substr($emp->name, 0, 2)) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $emp->name }}</div>
                                        @if($idx === 0)
                                            <span class="badge bg-warning text-dark py-0.5 px-1.5 small"><i class="bi bi-star-fill text-dark me-0.5"></i>Rank #1</span>
                                        @endif
                                    </td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary py-1 px-2.5 font-monospace fs-8">{{ $emp->team_name }}</span></td>
                                    <td class="text-end fw-bold text-success">{{ $emp->score }} Pts</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No monthly scores logged.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Team Leaderboard -->
        <div class="col-12 col-lg-6">
            <div class="card glass-card border-0 p-4 h-100">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold m-0"><i class="bi bi-people-fill text-info me-2"></i>Team Standings</h5>
                    <i class="bi bi-graph-up-arrow text-success fs-4"></i>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Team Name</th>
                                <th>Leader</th>
                                <th class="text-end">Team Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($team_leaderboard as $idx => $team)
                                <tr>
                                    <td>
                                        <span class="badge {{ $idx === 0 ? 'bg-warning text-dark' : 'bg-secondary' }} rounded-circle p-2 font-monospace" style="width: 25px; height: 25px; display: inline-flex; align-items: center; justify-content: center;">
                                            {{ $idx + 1 }}
                                        </span>
                                    </td>
                                    <td><div class="fw-bold text-primary">{{ $team->name }}</div></td>
                                    <td><span class="small fw-semibold text-secondary">{{ $team->leader_name }}</span></td>
                                    <td class="text-end fw-bold text-success">{{ $team->score }} Pts</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No team rankings available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Card -->
    <div class="card glass-card border-0 p-4 mb-4">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h5 class="fw-bold m-0">Need Detailed Audits?</h5>
                <p class="text-secondary small mb-0 mt-1">Generate points performance timelines, follow-up callbacks lists, and dynamic conversion analysis summaries directly.</p>
            </div>
            <a href="{{ route('reports.index') }}" class="btn btn-primary btn-rounded px-4 py-2.5 fw-semibold"><i class="bi bi-file-bar-graph me-1"></i> Open Reports Center</a>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // 1. Daily Trend Chart (HOD)
            const dailyCtx = document.getElementById('hodDailyTrendChart').getContext('2d');
            new Chart(dailyCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chart_days) !!},
                    datasets: [
                        {
                            label: 'Walk-ins',
                            data: {!! json_encode($chart_walkins) !!},
                            borderColor: '#00AA9E',
                            backgroundColor: 'rgba(0, 170, 158, 0.05)',
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3
                        },
                        {
                            label: 'Registrations',
                            data: {!! json_encode($chart_registrations) !!},
                            borderColor: '#0070BC',
                            backgroundColor: 'rgba(0, 112, 188, 0.05)',
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3
                        },
                        {
                            label: 'Admissions',
                            data: {!! json_encode($chart_admissions) !!},
                            borderColor: '#2D318F',
                            backgroundColor: 'rgba(45, 49, 143, 0.05)',
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    family: 'Inter',
                                    size: 11
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // 2. Status Breakdown Pie/Doughnut Chart
            const breakdownCtx = document.getElementById('hodStatusBreakdownChart').getContext('2d');
            new Chart(breakdownCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Admitted', 'Remaining Enquiries'],
                    datasets: [{
                        data: [
                            {{ $overall_admissions }},
                            {{ max(0, $overall_enquiries - $overall_admissions) }}
                        ],
                        backgroundColor: ['#2D318F', '#e9ecef'],
                        borderWidth: 2,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    family: 'Inter',
                                    size: 11
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
