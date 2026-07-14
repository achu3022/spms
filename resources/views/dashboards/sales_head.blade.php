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
                    <div class="text-secondary font-monospace small">COMPANY MONTHLY SCORE</div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
                <div class="fs-2 fw-bold text-primary">{{ $this_month_score }}</div>
                <div class="text-secondary small mt-1"><i class="bi bi-graph-up-arrow me-1"></i>Total accumulated points</div>
            </div>
        </div>
        
        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100 position-relative overflow-hidden card-hover">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-secondary font-monospace small">TOP TEAM</div>
                    <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success text-truncate">{{ $top_team ? $top_team->name : 'N/A' }}</div>
                <div class="text-secondary small mt-1"><i class="bi bi-trophy-fill text-success me-1"></i>{{ $top_team ? $top_team->score . ' Pts' : '0 Pts' }}</div>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="card glass-card p-3 border-0 h-100 position-relative overflow-hidden card-hover">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="text-secondary font-monospace small">TOP EMPLOYEE</div>
                    <div class="bg-info bg-opacity-10 text-info rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="bi bi-person-fill-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-info text-truncate">{{ $top_employee ? $top_employee->name : 'N/A' }}</div>
                <div class="text-secondary small mt-1"><i class="bi bi-award-fill text-info me-1"></i>{{ $top_employee ? $top_employee->score . ' Pts' : '0 Pts' }}</div>
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

    <!-- Removed Interactive Charts Section per request -->

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

    <!-- No charts to render -->
</x-app-layout>
