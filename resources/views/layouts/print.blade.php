<!DOCTYPE html>
<html>
<head>
    <title>Report Print - SMEC Labs</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #ffffff;
            color: #000000;
            padding: 30px;
        }
        .table th {
            background-color: #f8f9fa !important;
            color: #000000 !important;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <div>
                <h3 class="fw-bold text-uppercase" style="color: #2D318F;">SMEC Labs</h3>
                <h5 class="fw-semibold text-secondary m-0">{{ $report_title }}</h5>
                <small class="text-muted">Period: {{ date('M d, Y', strtotime($start_date)) }} to {{ date('M d, Y', strtotime($end_date)) }}</small>
            </div>
            <div class="no-print">
                <button class="btn btn-outline-secondary" onclick="window.close()"><i class="bi bi-x-circle"></i> Close</button>
                <button class="btn btn-primary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
            </div>
        </div>
        
        <div class="mt-4">
            @yield('content')
        </div>
    </div>
</body>
</html>
