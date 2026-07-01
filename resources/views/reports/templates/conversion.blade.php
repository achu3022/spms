<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>Executive ID</th>
                <th>Executive Name</th>
                <th>Total Enquiries Received</th>
                <th>Converted Admissions</th>
                <th class="text-end">Conversion Rate (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $rec)
                <tr>
                    <td><span class="small font-monospace fw-bold">{{ $rec->employee_id }}</span></td>
                    <td><span class="fw-bold">{{ $rec->employee_name }}</span></td>
                    <td><span class="small font-monospace">{{ $rec->total_enquiries }}</span></td>
                    <td><span class="small font-monospace fw-bold text-success">{{ $rec->converted_enquiries }}</span></td>
                    <td class="text-end fw-bold text-primary">{{ $rec->ratio }}%</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
