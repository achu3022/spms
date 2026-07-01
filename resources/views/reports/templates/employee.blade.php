<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Role (Spatie)</th>
                <th>Team</th>
                <th class="text-end">Period Score</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $rec)
                <tr>
                    <td><span class="small font-monospace fw-bold">{{ $rec->employeeProfile?->employee_id ?? 'N/A' }}</span></td>
                    <td><div class="fw-bold">{{ $rec->name }}</div><span class="small text-secondary">{{ $rec->email }}</span></td>
                    <td><span class="small text-secondary">{{ $rec->employeeProfile?->designation ?? 'N/A' }}</span></td>
                    <td><span class="small text-secondary">{{ $rec->employeeProfile?->department ?? 'N/A' }}</span></td>
                    <td><span class="badge bg-secondary py-1">{{ $rec->roles->first()?->name ?? 'None' }}</span></td>
                    <td><span class="small font-monospace">{{ $rec->team?->name ?? 'No Team' }}</span></td>
                    <td class="text-end fw-bold text-success">{{ $rec->period_score }} Pts</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
