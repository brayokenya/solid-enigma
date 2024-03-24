<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Timetracking;


class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query to fetch attendance records
        $query = Timetracking::query();

        // Apply filters if any
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->input('from_date'), $request->input('to_date')]);
        }

        if ($request->filled('code')) {
            $query->where('code', $request->input('code'));
        }

        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        if ($request->filled('id_number')) {
            $query->where('id_number', $request->input('id_number'));
        }


        $sortBy = $request->input('sort_by', 'date');
        $sortOrder = $request->input('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);


        // $attendances = $query->paginate(10);

        // return view('attendance.index', compact('attendances'));
        $attendances = $query->paginate(10);

        return view('timetrackings.index', compact('timetrackings'));
    }


}

// if ($request->filled('from_date')) {
//     $query->where('date', '>=', $request->input('from_date'));
// }

// if ($request->filled('to_date')) {
//     $query->where('date', '<=', $request->input('to_date'));
// }

// if ($request->filled('code')) {
//     $query->where('code', $request->input('code'));
// }

// if ($request->filled('department')) {
//     $query->where('department', $request->input('department'));
// }
