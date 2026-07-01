<x-app-layout>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Employee Accounts</h2>
            <p class="text-secondary small mb-0">Create and manage internal sales executives, heads of departments, and leaderboard profiles.</p>
        </div>
        <div>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-rounded fw-semibold py-2.5">
                <i class="bi bi-plus-circle me-1"></i> Register Employee
            </a>
        </div>
    </div>

    <div class="card glass-card border-0 p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle datatable">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Team</th>
                        <th>Spatie Role</th>
                        <th>Status</th>
                        <th>Last Login</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td><span class="small font-monospace fw-bold">{{ $user->employeeProfile?->employee_id ?? 'N/A' }}</span></td>
                            <td>
                                @if($user->employeeProfile?->photo)
                                    <img src="{{ asset('storage/' . $user->employeeProfile->photo) }}" width="40" height="40" class="rounded-circle object-fit-cover">
                                @else
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; font-size: 0.9rem;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $user->name }}</div>
                                <span class="small text-secondary">{{ $user->employeeProfile?->designation ?? 'Sales Executive' }}</span>
                            </td>
                            <td>
                                <div class="small">
                                    <div><i class="bi bi-envelope me-1"></i>{{ $user->email }}</div>
                                    @if($user->employeeProfile?->phone)
                                        <div><i class="bi bi-telephone me-1"></i>{{ $user->employeeProfile->phone }}</div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($user->team)
                                    <span class="badge bg-primary bg-opacity-10 text-primary py-1.5 px-2.5 font-monospace">{{ $user->team->name }}</span>
                                    @if($user->team_role !== 'member')
                                        <div class="text-secondary small mt-0.5 text-uppercase" style="font-size: 0.65rem;">{{ $user->team_role }}</div>
                                    @endif
                                @else
                                    <span class="text-muted small">No Team</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary py-1.5 px-2.5">{{ $user->roles->first()?->name ?? 'None' }}</span>
                            </td>
                            <td>
                                @if(($user->employeeProfile?->status ?? 'active') === 'active')
                                    <span class="badge bg-success bg-opacity-10 text-success py-1.5 px-2.5">Active</span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger py-1.5 px-2.5">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-secondary">
                                    {{ $user->employeeProfile?->last_login_at ? $user->employeeProfile->last_login_at->format('d M y H:i') : 'Never' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-light btn-sm rounded-circle text-primary" title="Edit account details"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely delete this employee account? This action cannot be undone.');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm rounded-circle text-danger" title="Delete employee"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No employees registered.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
