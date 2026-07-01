<?php

namespace App\Services;

use App\Exports\GenericReportExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\Response;

class ExportService
{
    /**
     * Export to Excel.
     */
    public function exportToExcel(string $view, array $data, string $filename): BinaryFileResponse
    {
        return Excel::download(new GenericReportExport($view, $data), $filename . '.xlsx');
    }

    /**
     * Export to PDF.
     */
    public function exportToPdf(string $view, array $data, string $filename, string $orientation = 'portrait'): Response
    {
        $data['inner_view'] = $view;
        $pdf = Pdf::loadView('reports.pdf_wrapper', $data)
            ->setPaper('a4', $orientation)
            ->setWarnings(false);
            
        return $pdf->download($filename . '.pdf');
    }
}
