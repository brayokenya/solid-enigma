<!-- resources/views/timetrackings/index.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Time Tracking Entries</h1>
    <!-- Filter Section -->
    <div class="mt-4">
        <form action="{{ route('timetrackings.index') }}" method="GET">
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 w-full md:w-1/4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="from_date">
                        From Date
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="from_date" name="from_date" type="date" value="{{ request('from_date') }}">
                </div>
                <div class="px-2 w-full md:w-1/4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="to_date">
                        To Date
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="to_date" name="to_date" type="date" value="{{ request('to_date') }}">
                </div>
                <div class="px-2 w-full md:w-1/4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="code">
                        Code
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="code" name="code" type="text" value="{{ request('code') }}">
                </div>
                <div class="px-2 w-full md:w-1/4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="department">
                        Department
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="department" name="department" type="text" value="{{ request('department') }}">
                </div>
                <div class="px-2 w-full md:w-1/4">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="department">
                        ID_Number
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="department" name="department" type="text" value="{{ request('department') }}">
                </div>

            </div>
            <div class="mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Apply Filter
                </button>
            </div>
            </div>
        </form>
    </div>

    <!-- Table for Time Tracking Entries -->
    <div class="overflow-x-auto mt-6">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    {{-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th> --}}
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID No.</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Branch</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Shift</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clock-in Time</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Clock-Out Time</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Worked Hours</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($timetrackings as $timetracking)
                <tr class="bg-white divide-y divide-gray-200">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->employee->casual_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->employee->first_name }} {{ $timetracking->employee->last_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->employee->id_number }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->date }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->employee->branch }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->shift }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->clock_in }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->clock_out }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $timetracking->worked_hours }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Export Buttons Section -->
    <div class="mt-4 flex justify-end">
        <div class="ml-4 flex">
            <a href="{{ route('timetrackings.export.excel') }}" class="btn btn-success">Export to Excel</a>
            <a href="{{ route('timetrackings.export.pdf') }}" class="btn btn-primary">Export to PDF</a>
        </div>
    </div>
</div>

@endsection
