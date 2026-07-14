<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $report_title }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #333; }
        .header p { margin: 5px 0 0; color: #666; font-size: 12px; }
        
        .summary-box { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .summary-item { text-align: center; flex: 1; }
        .summary-item h3 { margin: 0; font-size: 24px; color: #000; }
        .summary-item p { margin: 5px 0 0; font-size: 12px; text-transform: uppercase; color: #666; }

        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 8px 12px; text-align: left; }
        th { background-color: #f4f4f4; font-weight: bold; }
        
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #888; }
        
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Print Report</button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 10px;">Close</button>
    </div>

    <div class="header">
        <h2>{{ $report_title }}</h2>
        <p>Period: {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}</p>
        @if($employeeId)
            <p>Employee Filter Applied</p>
        @endif
        <p>Generated on: {{ now()->format('M d, Y H:i A') }}</p>
    </div>

    <div class="summary-box">
        <div class="summary-item">
            <h3>{{ $admissions }}</h3>
            <p>Admissions</p>
        </div>
        <div class="summary-item">
            <h3>{{ $walkins }}</h3>
            <p>Walk-ins</p>
        </div>
        <div class="summary-item">
            <h3>{{ $registrations }}</h3>
            <p>Registrations</p>
        </div>
        <div class="summary-item">
            <h3>{{ $payments }}</h3>
            <p>Full Payments</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Employee Name</th>
                <th style="text-align: center;">Walk-ins</th>
                <th style="text-align: center;">Registrations</th>
                <th style="text-align: center;">Admissions</th>
                <th style="text-align: center;">Full Payments</th>
            </tr>
        </thead>
        <tbody>
            @forelse($records as $record)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($record->date)->format('M d, Y') }}</td>
                    <td>{{ $record->user?->name ?? 'Unknown' }}</td>
                    <td style="text-align: center;">{{ $record->walkins }}</td>
                    <td style="text-align: center;">{{ $record->registrations }}</td>
                    <td style="text-align: center;">{{ $record->admissions }}</td>
                    <td style="text-align: center;">{{ $record->payments }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px;">No performance records found for the selected period.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>System Generated Report - SMEC SPMS</p>
    </div>

</body>
</html>
