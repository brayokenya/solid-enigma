<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeTracking;
use Barryvdh\DomPDF\Facade\Pdf;
use TCPDF;

class TimetrackingController extends Controller
{
    // Other methods in the controller...

    /**
     * Generate PDF for time tracking details.
     *
     * @param  \App\Models\Timetracking  $timetracking
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Timetracking $timetracking)
    {
        // Initialize TCPDF
        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Time Tracking Details');
        $pdf->SetSubject('Time Tracking Details');
        $pdf->SetKeywords('Time Tracking, PDF, Details');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add content to the PDF
        $pdfContent = "
            <h1>Time Tracking Details</h1>
            <p>From Date: " . $timetracking->FromDate . "</p>
            <p>To Date: " . $timetracking->ToDate . "</p>
            <p>Code: " . $timetracking->Code . "</p>
            <p>Department: " . $timetracking->Department . "</p>
            <p>ID Number: " . $timetracking->IDNumber . "</p>
            ";

        $pdf->writeHTML($pdfContent, true, false, true, false, '');

        // Output PDF as download
        $pdf->Output(public_path('pdfs/timetracking_details.pdf'), 'F');

        // Redirect back with success message
        return redirect()->back()->with('success', 'PDF generated successfully.');
    }
}
