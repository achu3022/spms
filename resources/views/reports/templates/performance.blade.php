<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Date and Time</th>
                <th>Executive</th>
                <th>Team</th>
                <th>Activity Type</th>
                <th>Remarks</th>
                <th class="text-end">Points Awarded</th>
            </tr>
        </thead>
        <tbody>
            @php $totPoints = 0; @endphp
            @forelse($records as $rec)
                @php $totPoints += $rec->score; @endphp
                <tr>
                    <td><span class="small text-secondary">{{ $rec->created_at->format('d/m/Y h:i A') }}</span></td>
                    <td><span class="fw-bold">{{ $rec->employee?->name ?? 'N/A' }}</span></td>
                    <td><span class="small font-monospace">{{ $rec->team?->name ?? 'No Team' }}</span></td>
                    <td>
                        @php
                            $badge = 'badge-new';
                            if(in_array(strtolower($rec->activity_type), ['walk-in', 'walk_in'])) $badge = 'badge-walkin';
                            elseif(strtolower($rec->activity_type) === 'registration') $badge = 'badge-registered';
                            elseif(strtolower($rec->activity_type) === 'admission') $badge = 'badge-admitted';
                            elseif(strtolower($rec->activity_type) === 'full payment') $badge = 'badge-payment';
                            elseif(strtolower($rec->activity_type) === 'follow-up') $badge = 'badge-followup';
                            elseif(strtolower($rec->activity_type) === 'lost') $badge = 'badge-lost';
                            elseif(strtolower($rec->activity_type) === 'cancelled') $badge = 'badge-cancelled';
                        @endphp
                        <span class="badge {{ $badge }} px-2 py-1">{{ $rec->activity_type }}</span>
                    </td>
                    <td><span class="small text-secondary">{{ $rec->remarks }}</span></td>
                    <td class="text-end fw-bold text-success">+{{ $rec->score }} Pts</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No points events found.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($records) > 0)
            <tfoot class="table-light">
                <tr class="fw-bold">
                    <td colspan="5" class="text-end">Total Period Score Earned:</td>
                    <td class="text-end text-success">+{{ $totPoints }} Pts</td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>
