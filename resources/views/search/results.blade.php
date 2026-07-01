<x-app-layout>
    <div class="mb-4">
        <h2 class="fw-bold mb-1">Search Results</h2>
        <p class="text-secondary small mb-0">Showing results for query: <strong class="text-primary font-monospace">"{{ $q }}"</strong></p>
    </div>

    <div class="card glass-card border-0 p-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-search me-2"></i>Enquiry Matches ({{ $enquiries->count() }})</h5>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Enquiry No</th>
                        <th>Student Name</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Branch</th>
                        <th>Assigned Executive</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enq)
                        <tr>
                            <td><span class="small font-monospace fw-bold">{{ $enq->enquiry_number }}</span></td>
                            <td>
                                <div class="fw-bold">{{ $enq->student_name }}</div>
                                <span class="text-secondary small">{{ $enq->place }}</span>
                            </td>
                            <td><span class="small">{{ $enq->phone_number }}</span></td>
                            <td><span class="small fw-semibold text-secondary">{{ $enq->course?->name ?? 'N/A' }}</span></td>
                            <td><span class="small text-secondary">{{ $enq->branch?->name ?? 'N/A' }}</span></td>
                            <td><span class="small fw-semibold">{{ $enq->assignedEmployee?->name ?? 'Unassigned' }}</span></td>
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
                            <td class="text-end">
                                <a href="{{ route('enquiries.show', $enq->id) }}" class="btn btn-light btn-sm rounded-circle" title="View details"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('enquiries.edit', $enq->id) }}" class="btn btn-light btn-sm rounded-circle text-primary" title="Edit details"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-secondary py-5">
                                <i class="bi bi-search-heart fs-1 text-secondary opacity-50"></i>
                                <div class="mt-2">No matching student records found.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
