<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Enquiry No</th>
                <th>Student Name</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Branch</th>
                <th>Lead Source</th>
                <th>Assigned Exec.</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $rec)
                <tr>
                    <td><span class="small font-monospace fw-bold">{{ $rec->enquiry_number }}</span></td>
                    <td><div class="fw-bold">{{ $rec->student_name }}</div><span class="small text-secondary">{{ $rec->place }}</span></td>
                    <td><span class="small">{{ $rec->phone_number }}</span></td>
                    <td><span class="small">{{ $rec->course?->name ?? 'N/A' }}</span></td>
                    <td><span class="small">{{ $rec->branch?->name ?? 'N/A' }}</span></td>
                    <td><span class="small">{{ $rec->leadSource?->name ?? 'N/A' }}</span></td>
                    <td><span class="small">{{ $rec->assignedEmployee?->name ?? 'Unassigned' }}</span></td>
                    <td><span class="small">{{ $rec->current_status }}</span></td>
                    <td><span class="small text-secondary">{{ $rec->created_at->format('d/m/Y') }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
