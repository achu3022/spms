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
                        <th>Leader</th>
                        <th>Vice Leader</th>
                        <th>Members Count</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                        <tr>
                            <td><div class="fw-bold text-primary">{{ $team->name }}</div></td>
                            <td><span class="small text-secondary">{{ $team->description ?? 'No description.' }}</span></td>
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
</x-app-layout>
