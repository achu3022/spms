<x-app-layout>
    <div class="mb-4">
        <a href="{{ route('teams.index') }}" class="btn btn-light btn-rounded py-2 small fw-semibold mb-2"><i class="bi bi-arrow-left me-1"></i> Back to Teams</a>
        <h2 class="fw-bold mb-1">Create Team</h2>
        <p class="text-secondary small mb-0">Define a new sales group, assign leaders, and choose members.</p>
    </div>

    <div class="card glass-card border-0 p-4">
        <form action="{{ route('teams.store') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Team Name *</label>
                    <input type="text" name="name" class="form-control" required placeholder="e.g. Alpha Performers">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Short team details/region">
                </div>

                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold">Monthly Score Target *</label>
                    <input type="number" name="target" class="form-control" required min="1" value="50">
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label small fw-semibold">Team Leader</label>
                    <select name="leader_id" class="form-select">
                        <option value="">Select Leader</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label small fw-semibold">Vice Team Leader</label>
                    <select name="vice_leader_id" class="form-select">
                        <option value="">Select Vice Leader</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <label class="form-label small fw-semibold d-block mb-2">Select Team Members</label>
                    <div class="row row-cols-1 row-cols-md-3 g-2 overflow-auto border rounded-4 p-3 bg-light dark-card" style="max-height: 250px;">
                        @foreach($users as $user)
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="member_ids[]" value="{{ $user->id }}" id="member_{{ $user->id }}">
                                    <label class="form-check-label small" for="member_{{ $user->id }}">
                                        {{ $user->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2 border-top pt-4 mt-4">
                    <a href="{{ route('teams.index') }}" class="btn btn-outline-secondary btn-rounded px-4 py-2 small fw-semibold">Cancel</a>
                    <button type="submit" class="btn btn-primary btn-rounded px-4 py-2.5 fw-semibold"><i class="bi bi-save me-1"></i> Save Team</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
