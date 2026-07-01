<x-app-layout>
    <div class="mb-4">
        <a href="{{ route('users.index') }}" class="btn btn-light btn-rounded py-2 small fw-semibold mb-2"><i class="bi bi-arrow-left me-1"></i> Back to Employees</a>
        <h2 class="fw-bold mb-1">Edit Employee Profile: {{ $user->name }}</h2>
        <p class="text-secondary small mb-0">Modify base account credentials, Spatie role scopes, and residential information.</p>
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
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="row g-3">
                <h5 class="fw-bold text-primary mb-1 col-12">1. Authentication Credentials</h5>
                
                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Full Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required placeholder="e.g. David Miller">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Email Address *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required placeholder="david@smeclabs.com">
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <label class="form-label small fw-semibold">Spatie Role *</label>
                    <select name="role" class="form-select" required>
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role', $currentRole) === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <label class="form-label small fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave empty to keep unchanged">
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <label class="form-label small fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Leave empty to keep unchanged">
                </div>

                <hr class="text-secondary opacity-25 my-4 col-12">
                <h5 class="fw-bold text-primary mb-1 col-12">2. Profile & Team Assignment</h5>

                <div class="col-12 col-md-6 col-lg-6">
                    <label class="form-label small fw-semibold">Employee ID *</label>
                    <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id', $user->employeeProfile?->employee_id) }}" required placeholder="e.g. SMEC-2026-004">
                </div>

                <div class="col-12 col-md-6 col-lg-6">
                    <label class="form-label small fw-semibold">Designation</label>
                    <input type="text" name="designation" class="form-control" value="{{ old('designation', $user->employeeProfile?->designation) }}" placeholder="e.g. Senior executive">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Select Team Assignment</label>
                    <select name="team_id" class="form-select">
                        <option value="">No Team (Standalone)</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" {{ old('team_id', $currentTeamId) == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Profile Photo</label>
                    <input type="file" name="photo" class="form-control">
                    @if($user->employeeProfile?->photo)
                        <div class="mt-2 p-1 bg-light border rounded d-inline-block">
                            <img src="{{ asset('storage/' . $user->employeeProfile->photo) }}" alt="Photo" width="50" height="50" class="rounded object-fit-cover">
                        </div>
                    @endif
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $user->employeeProfile?->status) === 'active' ? 'selected' : '' }}>Active (Can log in)</option>
                        <option value="inactive" {{ old('status', $user->employeeProfile?->status) === 'inactive' ? 'selected' : '' }}>Inactive / Blocked</option>
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2 border-top pt-4 mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-rounded px-4 py-2 small fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-rounded px-4 py-2.5 fw-semibold"><i class="bi bi-save me-1"></i> Save Changes</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
