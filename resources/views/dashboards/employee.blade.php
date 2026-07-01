<x-app-layout>
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">Employee Dashboard</h2>
            <p class="text-secondary small mb-0">Track your daily sales performance points, contact leads, and record student enquiries.</p>
        </div>
        <div class="w-100" style="max-width: max-content;">
            <button type="button" class="btn btn-primary btn-rounded fw-semibold py-2 px-4 w-100" data-bs-toggle="modal" data-bs-target="#dailyClosingModal">
                <i class="bi bi-plus-circle me-1"></i> Add Daily Closing
            </button>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="row g-3 mb-4 animate-fade-in">
        <div class="col-6 col-md-3">
            <div class="card glass-card p-3 border-0 h-100 text-center">
                <div class="text-secondary font-monospace small mb-1">TODAY'S POINTS</div>
                <div class="fs-1 fw-bold text-success">{{ $today_score }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card glass-card p-3 border-0 h-100 text-center">
                <div class="text-secondary font-monospace small mb-1">RECENT CLOSINGS</div>
                <div class="fs-1 fw-bold text-primary">{{ $daily_closings->sum('count') }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card glass-card p-3 border-0 h-100 text-center">
                <div class="text-secondary font-monospace small mb-1">MY RANK</div>
                <div class="fs-1 fw-bold text-warning">#{{ $my_rank }}</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card glass-card p-3 border-0 h-100 text-center">
                <div class="text-secondary font-monospace small mb-1">MY TEAM RANK</div>
                <div class="fs-1 fw-bold text-info">#{{ $my_team_rank }}</div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Chart -->
        <div class="col-12 col-lg-8">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3">My Performance (Points Trend)</h5>
                <div style="height: 280px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Right Column (Sidebar) -->
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

    <!-- Additional Info Row -->
    <div class="row g-4 mb-4">
        <!-- Points Reference Table -->
        <div class="col-12 col-lg-6">
            <div class="card glass-card border-0 p-4 h-100">
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

        <!-- Recent Daily Closings -->
        <div class="col-12 col-lg-6">
            <div class="card glass-card border-0 p-4 h-100">
                <h5 class="fw-bold mb-3 text-primary"><i class="bi bi-card-checklist me-1"></i> Recent Closings</h5>
                <div class="overflow-auto" style="max-height: 280px;">
                    @forelse($daily_closings as $closing)
                        <div class="p-2 border rounded-3 mb-2 bg-light dark-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold small">{{ $closing->closing_type }}</span>
                                <span class="badge bg-success">{{ $closing->count }}</span>
                            </div>
                            <div class="small text-secondary mt-1">
                                <i class="bi bi-calendar-event me-1"></i> {{ \Carbon\Carbon::parse($closing->date)->format('M d, Y') }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-clipboard-x fs-2 text-secondary"></i>
                            <div class="small mt-2">No recent daily closings found.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Closing Modal -->
    @push('modals')
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
                            <!-- Date -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Date *</label>
                                <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}" required readonly>
                                <div class="form-text text-muted small" style="font-size: 0.7rem;">You can only add closing data for today.</div>
                            </div>

                            <!-- Closing Type -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Type of Closing *</label>
                                <select name="closing_type" class="form-select" required>
                                    <option value="" disabled selected>Select closing type</option>
                                    <option value="Walk-in">Walk-in</option>
                                    <option value="Registration">Registration</option>
                                    <option value="Admission">Admission</option>
                                    <option value="Full Payment">Full Payment</option>
                                </select>
                            </div>

                            <!-- Count -->
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Number of Closings *</label>
                                <input type="number" name="count" class="form-control" min="1" placeholder="e.g. 5" required>
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
    <script>
        // Chart
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chart_days) !!},
                datasets: [{
                    label: 'My Daily Points',
                    data: {!! json_encode($chart_scores) !!},
                    borderColor: '#00AA9E',
                    backgroundColor: 'rgba(0, 170, 158, 0.15)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 3
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

        // Dynamic districts loader for modal
        $('#modal_state_select').change(function() {
            const stateId = $(this).val();
            const $districtSelect = $('#modal_district_select');
            
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
                        $districtSelect.append(`<option value="${district.id}">${district.name}</option>`);
                    });
                    $districtSelect.prop('disabled', false);
                },
                error: function() {
                    $districtSelect.empty().append('<option>Failed to load districts</option>');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
