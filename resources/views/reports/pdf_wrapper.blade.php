<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $report_title ?? 'Report' }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 11px; color: #333; margin: 0; padding: 10px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; color: #1a1a1a; }
        .header p { margin: 5px 0 0 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; font-weight: bold; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
        .text-success { color: #198754; }
        .text-primary { color: #0d6efd; }
        .small { font-size: 9px; }
        .badge { background-color: #e9ecef; border: 1px solid #ccc; padding: 2px 4px; border-radius: 3px; font-size: 9px; }
        tfoot td { font-weight: bold; background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $report_title ?? 'System Report' }}</h2>
        <p>Period: {{ \Carbon\Carbon::parse($start_date)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($end_date)->format('M d, Y') }}</p>
    </div>
    
    @include($inner_view)
</body>
</html>
