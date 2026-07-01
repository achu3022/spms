<x-app-layout>
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Performance Leaderboard</h2>
            <p class="text-secondary small mb-0">Track and compare sales performance scores for teams and individual executives.</p>
        </div>
        <div class="w-100" style="max-width: 450px;">
            <form action="{{ route('leaderboard') }}" method="GET" class="d-flex flex-wrap gap-2 w-100" id="leaderboardForm">
                <select name="period" id="periodSelect" class="form-select flex-grow-1" style="min-width: 140px;" onchange="toggleCustomDates()">
                    <option value="daily" {{ $period === 'daily' ? 'selected' : '' }}>Today's Points</option>
                    <option value="weekly" {{ $period === 'weekly' ? 'selected' : '' }}>This Week</option>
                    <option value="last_week" {{ $period === 'last_week' ? 'selected' : '' }}>Last Week</option>
                    <option value="monthly" {{ $period === 'monthly' ? 'selected' : '' }}>This Month</option>
                    <option value="last_month" {{ $period === 'last_month' ? 'selected' : '' }}>Last Month</option>
                    <option value="yearly" {{ $period === 'yearly' ? 'selected' : '' }}>This Year</option>
                    <option value="custom_month" {{ $period === 'custom_month' ? 'selected' : '' }}>Custom Month...</option>
                </select>
                
                <div id="customDateWrapper" class="gap-2 flex-grow-1 {{ $period === 'custom_month' ? 'd-flex' : 'd-none' }}">
                    <select name="custom_month" class="form-select">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ ($customMonth ?? now()->month) == $m ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                        @endforeach
                    </select>
                    <select name="custom_year" class="form-select">
                        @foreach(range(now()->year, now()->year - 5) as $y)
                            <option value="{{ $y }}" {{ ($customYear ?? now()->year) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary px-3"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <script>
                function toggleCustomDates() {
                    var period = document.getElementById('periodSelect').value;
                    var wrapper = document.getElementById('customDateWrapper');
                    if (period === 'custom_month') {
                        wrapper.classList.remove('d-none');
                        wrapper.classList.add('d-flex');
                    } else {
                        wrapper.classList.remove('d-flex');
                        wrapper.classList.add('d-none');
                        document.getElementById('leaderboardForm').submit();
                    }
                }
            </script>
        </div>
    </div>

    <!-- Top Performers Snippet Row -->
    <div class="row g-4 mb-4">
        <!-- Top Performer Employee -->
        <div class="col-12 col-md-6">
            <div class="card glass-card border-0 p-4 h-100 bg-opacity-75">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-1">🏆</span>
                    <div>
                        <div class="small text-secondary font-monospace">TOP INDIVIDUAL PERFORMER</div>
                        <h4 class="fw-bold text-primary mb-1">{{ $topEmployee ? $topEmployee->name : 'N/A' }}</h4>
                        <div class="small text-muted mb-2">{{ $topEmployee ? $topEmployee->designation : 'N/A' }}</div>
                        <span class="badge bg-success px-3 py-1.5 btn-rounded">{{ $topEmployee ? $topEmployee->score : 0 }} Points</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Performer Team -->
        <div class="col-12 col-md-6">
            <div class="card glass-card border-0 p-4 h-100 bg-opacity-75">
                <div class="d-flex align-items-center gap-3">
                    <span class="fs-1">🥇</span>
                    <div>
                        <div class="small text-secondary font-monospace">TOP PERFORMANCE TEAM</div>
                        <h4 class="fw-bold text-primary mb-1">{{ $topTeam ? $topTeam->name : 'N/A' }}</h4>
                        <div class="small text-muted mb-2">Lead: {{ $topTeam ? $topTeam->leader_name : 'N/A' }}</div>
                        <span class="badge bg-primary px-3 py-1.5 btn-rounded">{{ $topTeam ? $topTeam->score : 0 }} Points</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Employee rankings table -->
        <div class="col-12 col-lg-6">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3"><i class="bi bi-person-fill text-primary me-2"></i>Employee Leaderboard</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Employee</th>
                                <th>Team</th>
                                <th class="text-end">Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employeeRankings as $idx => $record)
                                <tr>
                                    <td><span class="fw-bold text-secondary">#{{ $idx + 1 }}</span></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($record->photo)
                                                <img src="{{ asset('storage/' . $record->photo) }}" width="35" height="35" class="rounded-circle object-fit-cover flex-shrink-0">
                                            @else
                                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                    {{ strtoupper(substr($record->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold" style="white-space: nowrap;">{{ $record->name }}</div>
                                                <div class="text-muted small" style="font-size: 0.75rem;">{{ $record->designation ?? 'Sales Executive' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="small font-monospace">{{ $record->team_name }}</span></td>
                                    <td class="text-end fw-bold text-success">{{ $record->score }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No points logged for this period.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Team rankings table -->
        <div class="col-12 col-lg-6">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3"><i class="bi bi-people-fill text-info me-2"></i>Team Leaderboard</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Team Name</th>
                                <th>Leader</th>
                                <th class="text-end">Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teamRankings as $idx => $record)
                                <tr>
                                    <td><span class="fw-bold text-secondary">#{{ $idx + 1 }}</span></td>
                                    <td><div class="fw-bold text-primary">{{ $record->name }}</div></td>
                                    <td><span class="small text-secondary">{{ $record->leader_name }}</span></td>
                                    <td class="text-end fw-bold text-success">{{ $record->score }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No team rankings available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
