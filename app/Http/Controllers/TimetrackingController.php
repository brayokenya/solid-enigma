<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetracking;
use App\Exports\TimetrackingsExport;
// use Barryvdh\DomPDF\Facade as PDF;
use App\Models\CasualEmployee;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use TCPDF;
use Illuminate\Support\Facades\Session;


class TimetrackingController extends Controller
{
    /**
     * Display a listing of the time trackings.
     *
     * @return \Illuminate\Http\Response
     */
    // TimeTrackingController.php

public function index(Request $request)
{
    // Filter parameters
    $fromDate = $request->input('from_date');
    $toDate = $request->input('to_date');
    $code = $request->input('code');
    $department = $request->input('department');
    $idNumber = $request->input('id_number');

    // Query Time Tracking Entries based on filters
    $timetrackings = TimeTracking::whereHas('employee', function ($query) use ($code, $department, $idNumber) {
        if ($code) {
            $query->where('casual_code', $code);
        }
        if ($department) {
            $query->where('department', $department);
        }
        if ($idNumber) {
            $query->where('id_number', $idNumber);
        }
    })
    ->when($fromDate, function ($query) use ($fromDate) {
        return $query->whereDate('date', '>=', $fromDate);
    })
    ->when($toDate, function ($query) use ($toDate) {
        return $query->whereDate('date', '<=', $toDate);
    })
    ->get();

    return view('timetrackings.index', compact('timetrackings'));
}

    // public function index()
    // {
    //     $timetrackings = Timetracking::all();

    //     return view('timetrackings.index', compact('timetrackings'));
    // }

    /**
     * Show the form for creating a new time tracking.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Return the view for creating a new time tracking entry
        return view('timetrackings.create');
    }

    /**
     * Store a newly created time tracking in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'employee_id' => 'required|exists:casual_employees,id',
            'clock_in' => 'required|date',
            'clock_out' => 'nullable|date',
            'date' => 'required|date',
        ]);

        // Create a new time tracking entry
        Timetracking::create($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Time tracking entry created successfully.');
    }

    /**
     * Display the specified time tracking.
     *
     * @param  \App\Models\Timetracking  $timetracking
     * @return \Illuminate\Http\Response
     */
    public function show(Timetracking $timetracking)
    {
        // Return the view with the specified time tracking data
        return view('timetrackings.show', compact('timetracking'));
    }
     /**
     * Export time tracking entries to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportToExcel()
    {
        return Excel::download(new TimetrackingsExport, 'timetrackings.xlsx');
    }
    public function downloadForm(Timetracking $timetrackings)
    {
        // Create a new TCPDF instance
        $pdf = new TCPDF();

        // Set document information
        $pdf->SetCreator('Your Name');
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Timetrackings');
        $pdf->SetSubject('Timetrackingss');

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add content to the PDF
        $pdf->writeHTML("First Name: $timetrackings->first_name <br>");
        $pdf->writeHTML("Last Name: $timetrackings->last_name <br>");
        // Add more fields as needed...

        // Output the PDF as a file
        $pdf->Output(public_path('pdfs/timetrackings_pdf'), 'F');

        // Set flash session with the file name for download
        Session::flash('download.in.the.next.request', 'timetrackings_pdf');

        // Redirect back to the dashboard with a success message
        return redirect('timetrackings.index')->with('success', 'PDF generated successfully!');
    }
    public function exportToPDF()
    {
        $timetrackings = Timetracking::all();

        // Generate PDF using DomPDF
        $pdf = PDF::loadView('timetrackings_pdf', compact('timetrackings'));

        // Save the PDF file to the public/pdf folder
        // $pdf->save(public_path('pdf/timetrackings_pdf'));

        return $pdf->download('timetrackings_pdf');
        // Optionally, you can return a response indicating success
        // return Response::make('PDF file generated and saved successfully.', 200);

    // Generate PDF using DomPDF
    }
    public function filter(Request $request)
    {
        // Validate the request data
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Retrieve filter criteria from the request
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $departmentId = $request->input('department_id');

        // Query the timetrackings table based on the filter criteria
        $timetrackings = Timetracking::whereBetween('date', [$fromDate, $toDate])
            ->whereHas('employee', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->get();

        // Pass the filtered timetrackings data to the view
        return view('timetrackings.index', ['timetrackings' => $timetrackings]);
    }
    public function clockIn(Request $request)
    {
        // Validate request data
        $request->validate([
            'employee_id' => 'required|exists:casual_employees,id',
        ]);

        // Create a new time tracking entry for clock in
        Timetracking::create([
            'employee_id' => $request->employee_id,
            'clock_in' => now(), // Use current server time for clock in
            'date' => now()->toDateString(),
        ]);

        return response()->json(['message' => 'Clock in successful'], 200);
    }

    public function clockOut(Request $request)
    {
        // Validate request data
        $request->validate([
            'employee_id' => 'required|exists:casual_employees,id',
        ]);

        // Find the latest time tracking entry for the employee
        $timeTracking = Timetracking::where('employee_id', $request->employee_id)
            ->whereDate('created_at', now()->toDateString())
            ->latest()
            ->first();

        if ($timeTracking) {
            // Update the clock out time
            $timeTracking->update(['clock_out' => now()]); // Use current server time for clock out
            return response()->json(['message' => 'Clock out successful'], 200);
        }

        return response()->json(['message' => 'No clock in found for the employee today'], 404);
    }

// Add the filter function
// public function index(Request $request)
//     {
//         $query = Timetracking::query();

//         // Apply filters
//         if ($request->filled('from_date')) {
//             $query->where('date', '>=', $request->input('from_date'));
//         }

//         if ($request->filled('to_date')) {
//             $query->where('date', '<=', $request->input('to_date'));
//         }

//         if ($request->filled('code')) {
//             $query->where('code', $request->input('code'));
//         }

//         if ($request->filled('department')) {
//             $query->where('department', $request->input('department'));
//         }

//         // Add handling for other filter options

//         $timetrackings = $query->paginate(10);

//         return view('timetrackings.index', compact('timetrackings'));
//     }
}
