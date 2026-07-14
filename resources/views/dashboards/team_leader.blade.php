<x-app-layout>
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Team Leader Dashboard</h2>
            @if($team)
                <p class="text-secondary small mb-0">Managing Team: <strong class="text-primary">{{ $team->name }}</strong></p>
            @else
                <p class="text-secondary small mb-0">You are not currently assigned to any team.</p>
            @endif
        </div>
        <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch align-items-sm-center w-100" style="max-width: max-content;">
            <span class="badge bg-primary px-3 py-2 btn-rounded fs-7 text-center">Active Month: {{ now()->format('F Y') }}</span>
            <button type="button" class="btn btn-primary btn-rounded fw-semibold py-2 px-4 w-100" data-bs-toggle="modal" data-bs-target="#dailyClosingModal">
                <i class="bi bi-plus-circle me-1"></i> Add Daily Closing
            </button>
        </div>
    </div>

    @if(!$team)
        <div class="alert alert-info rounded-4 border-0 p-4 mb-4">
            <h5 class="fw-bold"><i class="bi bi-info-circle-fill me-2"></i>No Team Assigned</h5>
            <p class="mb-0">You are not assigned as leader of any active team yet. Contact the Super Admin to configure your team assignment.</p>
        </div>
    @endif

    @if($team)
        <!-- Tabs Navigation -->
        <ul class="nav nav-pills mb-4 gap-2" id="leaderDashboardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active btn-rounded px-4" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">
                    <i class="bi bi-grid me-1"></i> Overview
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link btn-rounded px-4 bg-light text-dark border" id="performance-tab" data-bs-toggle="tab" data-bs-target="#performance" type="button" role="tab" aria-controls="performance" aria-selected="false">
                    <i class="bi bi-graph-up-arrow me-1 text-primary"></i> Team Performance
                </button>
            </li>
        </ul>

        <div class="tab-content" id="leaderDashboardTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                <!-- Team Stats row -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="card glass-card p-3 border-0 h-100">
                    <div class="text-secondary font-monospace small mb-1">TEAM MONTHLY SCORE</div>
                    <div class="fs-2 fw-bold text-success">{{ $team_score }}</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card glass-card p-3 border-0 h-100">
                    <div class="text-secondary font-monospace small mb-1">TEAM MEMBERS COUNT</div>
                    <div class="fs-2 fw-bold text-primary">{{ $team->users->count() }}</div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card glass-card p-3 border-0 h-100">
                    <div class="text-secondary font-monospace small mb-1">LOWEST PERFORMER</div>
                    @if(isset($lowest_member) && $lowest_member)
                        <div class="fs-4 fw-bold text-danger text-truncate" title="{{ $lowest_member->name }}">{{ $lowest_member->name }}</div>
                        <div class="small text-muted">{{ $lowest_member->score }} Pts</div>
                    @else
                        <div class="fs-4 fw-bold text-muted">N/A</div>
                    @endif
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card glass-card p-3 border-0 h-100">
                    <div class="text-secondary font-monospace small mb-1">TODAY'S ACTIVITIES</div>
                    <div class="fs-2 fw-bold text-info">{{ $today_activities->count() }}</div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- Member Rankings -->
            <div class="col-12 col-lg-6">
                <div class="card glass-card border-0 p-4 h-100">
                    <h5 class="fw-bold mb-3">Employee Leaderboard (My Team)</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Executive</th>
                                    <th>Designation</th>
                                    <th class="text-end">Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rankings as $idx => $member)
                                    <tr>
                                        <td><span class="fw-bold text-secondary">#{{ $idx + 1 }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if($member->photo)
                                                    <img src="{{ asset('storage/' . $member->photo) }}" width="30" height="30" class="rounded-circle object-fit-cover">
                                                @else
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                        👤
                                                    </div>
                                                @endif
                                                <div class="fw-bold">{{ $member->name }}</div>
                                            </div>
                                        </td>
                                        <td><span class="small text-muted">{{ $member->designation ?? 'Executive' }}</span></td>
                                        <td class="text-end fw-bold text-success">{{ $member->score }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No members found in this team.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Team Daily Trend -->
            <div class="col-12 col-lg-6">
                <div class="card glass-card border-0 p-4 h-100">
                    <h5 class="fw-bold mb-3">Team Performance (Last 7 Days)</h5>
                    <div style="height: 280px;">
                        <canvas id="teamChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Team Activities -->
        <div class="card glass-card border-0 p-4">
            <h5 class="fw-bold mb-3">Today's Team Activities Log</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle datatable">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Executive</th>
                            <th>Student</th>
                            <th>Activity</th>
                            <th>Points</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($today_activities as $act)
                            <tr>
                                <td><span class="small text-muted">{{ $act->created_at->format('h:i A') }}</span></td>
                                <td><span class="fw-semibold">{{ $act->employee->name }}</span></td>
                                <td>
                                    @if($act->enquiry)
                                        <a href="{{ route('enquiries.show', $act->enquiry->id) }}" class="fw-semibold text-decoration-none">
                                            {{ $act->enquiry->student_name }}
                                        </a>
                                    @else
                                        <span class="text-muted small fst-italic">Bulk Update</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $badge = 'badge-new';
                                        if(in_array(strtolower($act->activity_type), ['walk-in', 'walk_in'])) $badge = 'badge-walkin';
                                        elseif(strtolower($act->activity_type) === 'registration') $badge = 'badge-registered';
                                        elseif(strtolower($act->activity_type) === 'admission') $badge = 'badge-admitted';
                                        elseif(strtolower($act->activity_type) === 'full payment') $badge = 'badge-payment';
                                        elseif(strtolower($act->activity_type) === 'follow-up') $badge = 'badge-followup';
                                        elseif(strtolower($act->activity_type) === 'lost') $badge = 'badge-lost';
                                        elseif(strtolower($act->activity_type) === 'cancelled') $badge = 'badge-cancelled';
                                    @endphp
                                    <span class="badge {{ $badge }} px-2.5 py-1.5">{{ $act->activity_type }}</span>
                                </td>
                                <td><span class="fw-bold text-success">+{{ $act->score }}</span></td>
                                <td><span class="small text-secondary">{{ $act->remarks }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    <div class="row g-4 mt-1 mb-4">
        <div class="col-12 col-lg-8">
            <!-- My Recent Daily Closings -->
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-card-checklist me-1"></i> My Recent Closings</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type of Closing</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($daily_closings as $closing)
                                <tr>
                                    <td><span class="small text-muted"><i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($closing->date)->format('M d, Y') }}</span></td>
                                    <td><span class="fw-semibold">{{ $closing->closing_type }}</span></td>
                                    <td><span class="badge bg-success">{{ $closing->count }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">No recent daily closings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 d-flex flex-column gap-4">
            <!-- Top Performers -->
            <div class="card glass-card border-0 p-4">
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
                            <div class="small text-secondary">MY TODAY'S SCORE</div>
                            <div class="fs-4 fw-bold text-primary">{{ $today_score }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded-3 bg-white dark-card">
                            <div class="small text-secondary">MY MONTHLY SCORE</div>
                            <div class="fs-4 fw-bold text-success">{{ $monthly_score }}</div>
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="p-2 border rounded-3 bg-white dark-card">
                            <div class="small text-secondary" style="font-size: 0.75rem;">TEAM TODAY'S SCORE</div>
                            <div class="fs-4 fw-bold text-primary">{{ $team_today_score }}</div>
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="p-2 border rounded-3 bg-white dark-card">
                            <div class="small text-secondary" style="font-size: 0.75rem;">TEAM MONTHLY SCORE</div>
                            <div class="fs-4 fw-bold text-success">{{ $team_score }}</div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <a href="{{ route('leaderboard') }}" class="btn btn-outline-primary btn-rounded w-100 py-2 small fw-semibold">View Leaderboard</a>
                    </div>
                </div>
            </div>

            <!-- Points Reference Table -->
            <div class="card glass-card border-0 p-4">
                <h5 class="fw-bold mb-3"><i class="bi bi-star-fill text-warning me-1"></i> Activity Points Guide</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Activity Type</th>
                                <th class="text-end">Points Awarded</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($activity_points))
                                @foreach($activity_points as $point)
                                <tr>
                                    <td class="fw-semibold small">{{ $point['activity'] }}</td>
                                    <td class="text-end"><span class="badge bg-success px-2 py-1">+{{ $point['points'] }}</span></td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
                </div>
            </div>
            </div> <!-- End Overview Tab -->
            
            <!-- Team Performance Tab -->
            <div class="tab-pane fade" id="performance" role="tabpanel" aria-labelledby="performance-tab">
                <div class="card glass-card border-0 p-4">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
                        <h5 class="fw-bold mb-0">Custom Performance Report</h5>
                        <div style="min-width: 250px;">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-calendar3"></i></span>
                                <input type="text" id="performance-daterange" class="form-control border-start-0" readonly style="cursor: pointer; background-color: #fff;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="performanceTable">
                            <thead>
                                <tr>
                                    <th>Executive</th>
                                    <th>Designation</th>
                                    <th class="text-end">Points Earned</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data injected via AJAX -->
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                                        Loading performance data...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- End Tab Content -->
        @endif

    @push('modals')
    <!-- Daily Closing Modal -->
    <div class="modal fade" id="dailyClosingModal" tabindex="-1" aria-labelledby="dailyClosingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card border-0 bg-white" style="color: initial;">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold" id="dailyClosingModalLabel" style="color: var(--primary-color);">Add Daily Closing Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('daily-closings.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Date *</label>
                                <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" required readonly>
                                <div class="form-text text-muted small" style="font-size: 0.7rem;">You can only add closing data for today.</div>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-semibold">Walk-ins Count</label>
                                <input type="number" name="walkin_count" class="form-control" min="0" placeholder="e.g. 5">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-semibold">Registration</label>
                                <input type="number" name="registration_count" class="form-control" min="0" placeholder="e.g. 2">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-semibold">Admission</label>
                                <input type="number" name="admission_count" class="form-control" min="0" placeholder="e.g. 1">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-semibold">One Time Payment</label>
                                <input type="number" name="payment_count" class="form-control" min="0" placeholder="e.g. 1">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-secondary btn-rounded" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-rounded fw-semibold"><i class="bi bi-save me-1"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endpush

    @push('scripts')
    <!-- DateRangePicker CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    @if($team)
    <script>
        const ctx = document.getElementById('teamChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chart_days) !!},
                datasets: [{
                    label: 'Team Daily Score',
                    data: {!! json_encode($chart_scores) !!},
                    backgroundColor: 'rgba(45, 49, 143, 0.75)',
                    borderColor: '#2D318F',
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        $(document).ready(function() {
            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#performance-daterange').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                fetchPerformanceData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            }

            $('#performance-daterange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

            function fetchPerformanceData(startDate, endDate) {
                var tbody = $('#performanceTable tbody');
                tbody.html('<tr><td colspan="3" class="text-center text-muted py-4"><div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>Loading performance data...</td></tr>');
                
                $.ajax({
                    url: '{{ route("team.performance.data") }}',
                    method: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        tbody.empty();
                        if (response.data && response.data.length > 0) {
                            response.data.forEach(function(member) {
                                var photoHtml = member.photo 
                                    ? `<img src="${member.photo}" width="30" height="30" class="rounded-circle object-fit-cover">`
                                    : `<div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; font-size: 0.8rem;">👤</div>`;
                                
                                var row = `
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                ${photoHtml}
                                                <div class="fw-bold">${member.name}</div>
                                            </div>
                                        </td>
                                        <td><span class="small text-muted">${member.designation}</span></td>
                                        <td class="text-end fw-bold text-success">${member.score}</td>
                                    </tr>
                                `;
                                tbody.append(row);
                            });
                        } else {
                            tbody.html('<tr><td colspan="3" class="text-center text-muted py-4">No data available for the selected period.</td></tr>');
                        }
                    },
                    error: function() {
                        tbody.html('<tr><td colspan="3" class="text-center text-danger py-4">Failed to load performance data.</td></tr>');
                    }
                });
            }
        });
    </script>
    @endif
    @endpush
</x-app-layout>
