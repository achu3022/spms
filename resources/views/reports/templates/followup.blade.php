<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Student Name</th>
                <th>Phone Number</th>
                <th>Contact Date</th>
                <th>Contact Status</th>
                <th>Remarks / Conversation Notes</th>
                <th>Next Scheduled Callback</th>
                <th>Handled By</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $rec)
                <tr>
                    <td>
                        @if($rec->enquiry)
                            <a href="{{ route('enquiries.show', $rec->enquiry->id) }}" class="fw-bold text-decoration-none">{{ $rec->enquiry->student_name }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td><span class="small">{{ $rec->enquiry?->phone_number ?? 'N/A' }}</span></td>
                    <td><span class="small">{{ $rec->follow_up_date->format('d/m/Y') }} {{ $rec->follow_up_time }}</span></td>
                    <td><span class="badge bg-secondary py-1">{{ $rec->status }}</span></td>
                    <td><span class="small text-secondary">{{ $rec->remarks }}</span></td>
                    <td>
                        @if($rec->next_follow_up_date)
                            <span class="small fw-semibold text-primary"><i class="bi bi-clock me-1"></i>{{ $rec->next_follow_up_date->format('d/m/Y') }} {{ $rec->next_follow_up_time }}</span>
                        @else
                            N/A
                        @endif
                    </td>
                    <td><span class="small fw-semibold">{{ $rec->employee?->name ?? 'N/A' }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No follow-ups logged for the selected period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
