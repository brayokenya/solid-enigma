<?php
namespace App\Http\Controllers;

use TCPDF;

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


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;


// use TCPDF;

// class PDFController extends Controller
// {
//     public function generatePDF()
//     {
        // Create new PDF document
        // $pdf = new TCPDF();

        // Set document information
        // $pdf->SetCreator('Becky');
        // $pdf->SetAuthor('Becky');
        // $pdf->SetTitle('CasualPDF');
        // $pdf->SetSubject('CasualPDF');
        // $pdf->SetKeywords('TCPDF, PDF, example, test');

        // Add a page
        // $pdf->AddPage();

        // Set font
        // $pdf->SetFont('times', '', 12);

        // Add content
        // $pdf->Write(5, 'Hello, World!');

        // Close and output PDF
    //     $pdf->Output('example.pdf', 'I');
    // }
    // public function downloadPDF()
    // {
        // Generate PDF content (if not already generated)
        // $pdfContent = $this->generatePDF($formData);

        // Output PDF as download
        // $pdf = new TCPDF();
        // Configure TCPDF as needed

        // Output PDF content as download
//         $pdf->Output('casual_employee_form.pdf', 'D');
//     }
// }





