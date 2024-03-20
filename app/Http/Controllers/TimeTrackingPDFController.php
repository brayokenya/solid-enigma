<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeTracking;
use Barryvdh\DomPDF\Facade\Pdf;

class TimeTrackingPDFController extends Controller
{
    public function exportToPDF()
    {
        // Retrieve time tracking data
        $timetrackings = TimeTracking::all();

        // Load the view and pass the time tracking data to it
        $pdf = PDF::loadView('timetrackings.pdf', compact('timetrackings'));

        // Return the PDF as a download
        return $pdf->download('timetrackings.pdf');
    }
}
