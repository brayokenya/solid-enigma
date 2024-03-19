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


class TimetrackingController extends Controller
{
    /**
     * Display a listing of the time trackings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all time trackings from the database
        $timetrackings = Timetracking::all();

        // Return the view with the time trackings data
        return view('timetrackings.index', compact('timetrackings'));
    }

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

    public function exportToPDF()
    {
        $timetrackings = Timetracking::all();
        $pdf = PDF::loadView('timetrackings.pdf', compact('timetrackings'));
        return $pdf->download('timetrackings.pdf');
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
}
