<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CasualEmployee;

class CasualInfoController extends Controller
{
    public function index(Request $request)
    {
        // Start building the query to fetch casual employees
        $query = CasualEmployee::query();

        // Apply filters if any
        if ($request->filled('name')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->input('name') . '%');
            });
        }

        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Sort casual employees
        $sortBy = $request->input('sort_by', 'first_name');
        $sortOrder = $request->input('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Retrieve casual employees
        $casualEmployees = $query->paginate(10);

        // Pass the paginated casual employees to the view
        return view('casual_info.index', compact('casualEmployees'));
    }

    public function info()
    {
        // Replace CasualInfo with your actual model name if it exists
        $casualInfo = CasualEmployee::all(['id', 'first_name', 'last_name', 'id_number', 'casual_code', 'branch', 'phone_number', 'gender', 'department', 'rate_per_day', 'status']);

        // Pass the casual info data to the view
        return view('casual_info.index', ['casualInfo' => $casualInfo]);
    }

    public function show($id)
    {
        $casualEmployee = CasualEmployee::findOrFail($id);
        return view('casual_info.show', compact('casualEmployee'));
    }
}
