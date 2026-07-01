<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Enquiry No</th>
                <th>Student Name</th>
                <th>Course</th>
                <th>Branch</th>
                <th>Assigned Exec.</th>
                <th>Adm. Fee</th>
                <th>Paid</th>
                <th>Balance</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totAdm = 0; $totPaid = 0; $totBal = 0;
            @endphp
            @forelse($records as $rec)
                @php
                    $pay = $rec->payments->last();
                    $admFee = $pay ? $pay->admission_amount : 0;
                    $paid = $pay ? $pay->paid_amount : 0;
                    $bal = $pay ? $pay->balance : 0;
                    $totAdm += $admFee; $totPaid += $paid; $totBal += $bal;
                @endphp
                <tr>
                    <td><span class="small font-monospace fw-bold">{{ $rec->enquiry_number }}</span></td>
                    <td><div class="fw-bold">{{ $rec->student_name }}</div><span class="small text-secondary">{{ $rec->phone_number }}</span></td>
                    <td><span class="small">{{ $rec->course?->name ?? 'N/A' }}</span></td>
                    <td><span class="small">{{ $rec->branch?->name ?? 'N/A' }}</span></td>
                    <td><span class="small">{{ $rec->assignedEmployee?->name ?? 'Unassigned' }}</span></td>
                    <td><span class="small fw-semibold">₹{{ number_format($admFee, 2) }}</span></td>
                    <td><span class="small text-success fw-bold">₹{{ number_format($paid, 2) }}</span></td>
                    <td><span class="small text-danger fw-bold">₹{{ number_format($bal, 2) }}</span></td>
                    <td><span class="small text-secondary">{{ $rec->updated_at->format('d/m/Y') }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-muted">No records found.</td>
                </tr>
            @endforelse
        </tbody>
        @if(count($records) > 0)
            <tfoot class="table-light">
                <tr class="fw-bold">
                    <td colspan="5" class="text-end">Total Summary:</td>
                    <td>₹{{ number_format($totAdm, 2) }}</td>
                    <td class="text-success">₹{{ number_format($totPaid, 2) }}</td>
                    <td class="text-danger">₹{{ number_format($totBal, 2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        @endif
    </table>
</div>
