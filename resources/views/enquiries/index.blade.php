<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Student Enquiries</h2>
            <p class="text-secondary small mb-0">List and manage student registrations, follow-ups, and admissions.</p>
        </div>
        <div>
            <a href="{{ route('enquiries.create') }}" class="btn btn-primary btn-rounded fw-semibold py-2.5">
                <i class="bi bi-plus-circle me-1"></i> Register New Enquiry
            </a>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="card glass-card border-0 p-4 mb-4">
        <form action="{{ route('enquiries.index') }}" method="GET" class="row g-3">
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold">Branch</label>
                <select name="branch_id" class="form-select small">
                    <option value="">All Branches</option>
                    @foreach($branches as $b)
                        <option value="{{ $b->id }}" {{ request('branch_id') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold">Course</label>
                <select name="course_id" class="form-select small">
                    <option value="">All Courses</option>
                    @foreach($courses as $c)
                        <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold">Lead Source</label>
                <select name="lead_source_id" class="form-select small">
                    <option value="">All Sources</option>
                    @foreach($leadSources as $ls)
                        <option value="{{ $ls->id }}" {{ request('lead_source_id') == $ls->id ? 'selected' : '' }}>{{ $ls->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-md-3">
                <label class="form-label small fw-semibold">Status</label>
                <select name="current_status" class="form-select small">
                    <option value="">All Statuses</option>
                    <option value="New" {{ request('current_status') == 'New' ? 'selected' : '' }}>New</option>
                    <option value="Walk-in" {{ request('current_status') == 'Walk-in' ? 'selected' : '' }}>Walk-in</option>
                    <option value="Registered" {{ request('current_status') == 'Registered' ? 'selected' : '' }}>Registered</option>
                    <option value="Admitted" {{ request('current_status') == 'Admitted' ? 'selected' : '' }}>Admitted</option>
                    <option value="Full Payment" {{ request('current_status') == 'Full Payment' ? 'selected' : '' }}>Full Payment</option>
                    <option value="Follow-up" {{ request('current_status') == 'Follow-up' ? 'selected' : '' }}>Follow-up</option>
                    <option value="Lost" {{ request('current_status') == 'Lost' ? 'selected' : '' }}>Lost</option>
                    <option value="Cancelled" {{ request('current_status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            
            <div class="col-12 d-flex gap-2 justify-content-end mt-4">
                <a href="{{ route('enquiries.index') }}" class="btn btn-outline-secondary btn-rounded px-4 py-2 small fw-semibold">Reset</a>
                <button type="submit" class="btn btn-primary btn-rounded px-4 py-2 small fw-semibold"><i class="bi bi-filter me-1"></i> Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Enquiries Data Table -->
    <div class="card glass-card border-0 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead>
                    <tr>
                        <th>Enquiry No</th>
                        <th>Student Name</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Branch</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enq)
                        <tr>
                            <td><span class="small font-monospace fw-bold">{{ $enq->enquiry_number }}</span></td>
                            <td><div class="fw-bold">{{ $enq->student_name }}</div><span class="text-secondary small">{{ $enq->place }}</span></td>
                            <td><span class="small">{{ $enq->phone_number }}</span></td>
                            <td><span class="small fw-semibold text-secondary">{{ $enq->course?->name ?? 'N/A' }}</span></td>
                            <td><span class="small text-secondary">{{ $enq->branch?->name ?? 'N/A' }}</span></td>
                            <td>
                                <div class="small">
                                    <strong>{{ $enq->assignedEmployee?->name ?? 'Unassigned' }}</strong>
                                    <div class="text-muted text-uppercase font-monospace" style="font-size: 0.65rem;">{{ $enq->assignedTeam?->name ?? 'No Team' }}</div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $badge = 'badge-new';
                                    if(strtolower($enq->current_status) === 'walk-in') $badge = 'badge-walkin';
                                    elseif(strtolower($enq->current_status) === 'registered') $badge = 'badge-registered';
                                    elseif(strtolower($enq->current_status) === 'admitted') $badge = 'badge-admitted';
                                    elseif(in_array(strtolower($enq->current_status), ['full payment', 'full_payment'])) $badge = 'badge-payment';
                                    elseif(strtolower($enq->current_status) === 'follow-up') $badge = 'badge-followup';
                                    elseif(strtolower($enq->current_status) === 'lost') $badge = 'badge-lost';
                                    elseif(strtolower($enq->current_status) === 'cancelled') $badge = 'badge-cancelled';
                                @endphp
                                <span class="badge {{ $badge }} px-2.5 py-1.5">{{ $enq->current_status }}</span>
                            </td>
                            <td><span class="fw-bold text-success">{{ $enq->total_score }} Pts</span></td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('enquiries.show', $enq->id) }}" class="btn btn-light btn-sm rounded-circle" title="View details"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('enquiries.edit', $enq->id) }}" class="btn btn-light btn-sm rounded-circle text-primary" title="Edit details"><i class="bi bi-pencil"></i></a>
                                    @role('Super Admin|Sales Head (HOD)')
                                    <form action="{{ route('enquiries.destroy', $enq->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry record?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger" title="Delete record"><i class="bi bi-trash"></i></button>
                                    </form>
                                    @endrole
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-secondary py-4">No enquiries matched your filters.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
