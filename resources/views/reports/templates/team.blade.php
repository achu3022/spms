<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Team Name</th>
                <th>Team Leader</th>
                <th>Vice Leader</th>
                <th>Members Count</th>
                <th class="text-end">Period Performance Score</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $rec)
                <tr>
                    <td><div class="fw-bold text-primary">{{ $rec->name }}</div><span class="small text-secondary">{{ $rec->description }}</span></td>
                    <td><span class="small">{{ $rec->leader?->name ?? 'None' }}</span></td>
                    <td><span class="small text-secondary">{{ $rec->viceLeader?->name ?? 'None' }}</span></td>
                    <td><span class="small font-monospace">{{ $rec->users->count() }}</span></td>
                    <td class="text-end fw-bold text-success">{{ $rec->period_score }} Pts</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No teams found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
