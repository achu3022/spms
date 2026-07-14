<x-app-layout>
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Past Activities</h1>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="card-title mb-0">Record Activities for Previous Days</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('past-activities.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="employee_id" class="form-label fw-semibold">Employee <span class="text-danger">*</span></label>
                            <select name="employee_id" id="employee_id" class="form-select @error('employee_id') is-invalid @enderror" required>
                                <option value="">Select Employee...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('employee_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="date" class="form-label fw-semibold">Date <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', date('Y-m-d', strtotime('-1 day'))) }}" max="{{ date('Y-m-d') }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mt-4">
                            <h6 class="mb-3 text-secondary">Activity Counts (Leave blank or 0 if none)</h6>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="walk_in" class="form-label text-muted small mb-1">Walk-ins</label>
                                    <input type="number" name="walk_in" id="walk_in" class="form-control @error('walk_in') is-invalid @enderror" value="{{ old('walk_in', 0) }}" min="0">
                                    @error('walk_in')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="registration" class="form-label text-muted small mb-1">Registrations</label>
                                    <input type="number" name="registration" id="registration" class="form-control @error('registration') is-invalid @enderror" value="{{ old('registration', 0) }}" min="0">
                                    @error('registration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="admission" class="form-label text-muted small mb-1">Admissions</label>
                                    <input type="number" name="admission" id="admission" class="form-control @error('admission') is-invalid @enderror" value="{{ old('admission', 0) }}" min="0">
                                    @error('admission')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="full_payment" class="form-label text-muted small mb-1">Full Payments</label>
                                    <input type="number" name="full_payment" id="full_payment" class="form-control @error('full_payment') is-invalid @enderror" value="{{ old('full_payment', 0) }}" min="0">
                                    @error('full_payment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                                <i class="bi bi-save me-2"></i> Save Activities
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employeeSelect = document.getElementById('employee_id');
            const dateInput = document.getElementById('date');
            
            const inputs = {
                'Walk-in': document.getElementById('walk_in'),
                'Registration': document.getElementById('registration'),
                'Admission': document.getElementById('admission'),
                'Full Payment': document.getElementById('full_payment')
            };

            function fetchExistingData() {
                const employeeId = employeeSelect.value;
                const date = dateInput.value;

                if (employeeId && date) {
                    fetch(`{{ route('past-activities.existing') }}?employee_id=${employeeId}&date=${date}`)
                        .then(response => response.json())
                        .then(data => {
                            // Reset all to 0 first
                            Object.values(inputs).forEach(input => {
                                if(input) input.value = 0;
                            });

                            // Fill with existing data
                            for (const [type, count] of Object.entries(data)) {
                                if (inputs[type]) {
                                    inputs[type].value = count;
                                }
                            }
                        })
                        .catch(error => console.error('Error fetching existing data:', error));
                }
            }

            employeeSelect.addEventListener('change', fetchExistingData);
            dateInput.addEventListener('change', fetchExistingData);
            
            // Initial fetch if values exist (e.g., on page load with old values)
            fetchExistingData();
        });
    </script>
    @endpush
</x-app-layout>
