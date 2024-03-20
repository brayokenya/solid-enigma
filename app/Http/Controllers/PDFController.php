<?php
namespace App\Http\Controllers;

use TCPDF;
use App\Models\CasualEmployee;
use Illuminate\Support\Facades\Redirect;

class PDFController extends Controller
{
    public function generatePDF($casualEmployee)
    {
        // Generate PDF content based on the provided casualEmployee data
        $pdf = new TCPDF();
        // Configure TCPDF as needed

        // Add content to the PDF
        $pdf->AddPage();
        $pdf->SetFont('times', '', 12);
        $pdf->Write(5, 'Form Content Here');

        // Output PDF content as download
        $pdf->Output(public_path('pdfs/casual_employee_details.pdf'), 'F');

        return redirect()->back()->with('success', 'PDF generated successfully.');
    }
}

