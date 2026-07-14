<x-app-layout>
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Target Settings</h2>
        <p class="text-secondary small mb-0">Set monthly score targets for individual employees.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 shadow-sm p-4 mb-4">
            <h6 class="fw-bold mb-2">Please correct the following:</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card glass-card border-0 p-4 mb-4">
        <h5 class="fw-bold text-primary mb-3">1. Team Targets</h5>
        <form action="{{ route('target-settings.update') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="team">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label small fw-semibold">Select Team *</label>
                    <select name="team_id" class="form-select" id="teamSelect" required>
                        <option value="">-- Choose Team --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" data-target="{{ $teamTargets[$team->id] ?? 50 }}">
                                {{ $team->name }}
                            </option>
                        @endforeach
                    </select>
                    @if(count($teams) === 0)
                        <div class="form-text text-danger">No teams found. Please add teams first.</div>
                    @endif
                </div>

                <div class="col-12 col-md-5">
                    <label class="form-label small fw-semibold">Monthly Score Target *</label>
                    <input type="number" name="target" id="teamTargetInput" class="form-control fw-bold" value="" placeholder="Select a team first" required min="1">
                </div>

                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary btn-rounded w-100 py-2 fw-semibold" {{ count($teams) === 0 ? 'disabled' : '' }}>
                        <i class="bi bi-save me-1"></i> Update Team
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="card glass-card border-0 p-4 mb-4">
        <h5 class="fw-bold text-primary mb-3">2. Individual Employee Targets</h5>
        <form action="{{ route('target-settings.update') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="employee">
            <div class="row g-3 align-items-end">
                <div class="col-12 col-md-5">
                    <label class="form-label small fw-semibold">Select Employee *</label>
                    <select name="user_id" class="form-select" id="employeeSelect" required>
                        <option value="">-- Choose Employee --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->id }}" data-target="{{ $u->employeeProfile?->target ?? 10 }}">
                                {{ $u->name }} ({{ $u->employeeProfile?->employee_id ?? 'No ID' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-5">
                    <label class="form-label small fw-semibold">Monthly Score Target *</label>
                    <input type="number" name="target" id="targetInput" class="form-control fw-bold" value="" placeholder="Select an employee first" required min="0">
                </div>

                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary btn-rounded w-100 py-2 fw-semibold">
                        <i class="bi bi-save me-1"></i> Update Employee
                    </button>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.getElementById('employeeSelect').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var targetInput = document.getElementById('targetInput');
            
            if (this.value) {
                targetInput.value = selectedOption.getAttribute('data-target');
            } else {
                targetInput.value = '';
            }
        });

        const teamSelect = document.getElementById('teamSelect');
        if (teamSelect) {
            teamSelect.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var targetInput = document.getElementById('teamTargetInput');
                
                if (this.value) {
                    targetInput.value = selectedOption.getAttribute('data-target');
                } else {
                    targetInput.value = '';
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
