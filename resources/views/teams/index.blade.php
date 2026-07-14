<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Teams Management</h2>
            <p class="text-secondary small mb-0">Manage unlimited teams, assign leaders/vice-leaders, and review team memberships.</p>
        </div>
        <div>
            <a href="{{ route('teams.create') }}" class="btn btn-primary btn-rounded fw-semibold py-2.5">
                <i class="bi bi-plus-circle me-1"></i> Create Team
            </a>
        </div>
    </div>

    <div class="card glass-card border-0 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead>
                    <tr>
                        <th>Team Name</th>
                        <th>Description</th>
                        <th>Target</th>
                        <th>Leader</th>
                        <th>Vice Leader</th>
                        <th>Members Count</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#teamModal{{ $team->id }}" class="text-decoration-none">
                                    <div class="fw-bold text-primary">{{ $team->name }}</div>
                                </a>
                            </td>
                            <td><span class="small text-secondary">{{ $team->description ?? 'No description.' }}</span></td>
                            <td><span class="badge bg-primary text-white">{{ $team->target }}</span></td>
                            <td>
                                @if($team->leader)
                                    <span class="fw-semibold"><i class="bi bi-person-fill text-primary me-1"></i>{{ $team->leader->name }}</span>
                                @else
                                    <span class="text-muted small">None</span>
                                @endif
                            </td>
                            <td>
                                @if($team->viceLeader)
                                    <span class="small"><i class="bi-person text-secondary me-1"></i>{{ $team->viceLeader->name }}</span>
                                @else
                                    <span class="text-muted small">None</span>
                                @endif
                            </td>
                            <td><span class="badge bg-secondary font-monospace">{{ $team->users->count() }}</span></td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('teams.edit', $team->id) }}" class="btn btn-light btn-sm rounded-circle text-primary" title="Edit team details"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('teams.destroy', $team->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this team? All member relationships will be cleared.');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger" title="Delete team"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('modals')
    @foreach($teams as $team)
    <!-- Team Members Modal -->
    <div class="modal fade" id="teamModal{{ $team->id }}" tabindex="-1" aria-labelledby="teamModalLabel{{ $team->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light border-0">
                    <h5 class="modal-title fw-bold" id="teamModalLabel{{ $team->id }}">{{ $team->name }} Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    @if($team->users->count() > 0)
                        <ul class="list-group list-group-flush">
                            @foreach($team->users as $member)
                                <li class="list-group-item d-flex align-items-center p-3">
                                    @if($member->employeeProfile && $member->employeeProfile->photo)
                                        <img src="{{ asset('storage/' . $member->employeeProfile->photo) }}" width="40" height="40" class="rounded-circle object-fit-cover border me-3">
                                    @else
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold text-dark">{{ $member->name }}</div>
                                        <div class="small text-secondary">
                                            @if($team->leader?->id == $member->id)
                                                <span class="badge bg-primary bg-opacity-10 text-primary py-0 px-2 rounded-pill">Team Leader</span>
                                            @elseif($team->viceLeader?->id == $member->id)
                                                <span class="badge bg-info bg-opacity-10 text-info py-0 px-2 rounded-pill">Vice Leader</span>
                                            @else
                                                {{ $member->employeeProfile?->designation ?? 'Executive' }}
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center text-muted p-4 py-5">
                            <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                            No members assigned to this team yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endpush
</x-app-layout>
