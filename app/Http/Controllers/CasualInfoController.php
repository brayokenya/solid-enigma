<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CasualEmployee;

class CasualInfoController extends Controller
{
    public function index(Request $request)
    {
        $query = CasualEmployee::query();

        // Apply filters if any
        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->input('name') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('name') . '%');
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

        // Paginate the results
        $casualEmployees = $query->paginate(10);

        return view('casual_info.index', compact('casualEmployees'));
    }

    public function show($id)
    {
        $casualEmployee = CasualEmployee::findOrFail($id);
        return view('casual_info.show', compact('casualEmployee'));
    }
}
