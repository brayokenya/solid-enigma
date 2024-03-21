<!-- resources/views/timetrackings/index.blade.php -->

@extends('layouts.app')

@section('content')

            <div class="container">
                <h1>Time Tracking Entries</h1>
                <!-- Display time tracking entries here -->
                <table class="table">
            <thead class="bg-gray-50">
                <tr>
                    <!-- First Row -->
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        From Date
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        To Date
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Code
                    </th>
                    <!-- Second Row -->
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Department
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID/Passport Number
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        First Name
                    </th>
                    <!-- Add similar th elements for other fields -->
                </tr>
            </thead>

              </div>
                <div class="col-xs-6 col-md-4">
                    <!-- Sidebar content -->
                </div>
            </div>

        </table>
            <!-- Table for Casual Employees -->
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <!-- First Row -->
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                From Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                To Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Code
                            </th>
                            <!-- Second Row -->
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Department
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID Number
                            </th>
                            <!-- Add similar th elements for other fields -->
                        </tr>
        </div>
<div class="mt-4 flex justify-end">
    <div class="ml-4 flex">
        <!-- Filter Button -->
        {{-- <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Dropdown</button>
            <div id="myDropdown" class="dropdown-content">
              <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
              <a href="#about">From Date</a>
              <a href="#base">To Date</a>
              <a href="#blog">Code</a>
              <a href="#blog">DEpartment</a>
              <a href="#blog">ID Number</a>
            </div>
        </div> --}}
        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <!-- Heroicon name: filter -->
            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h12a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1zM3 9a1 1 0 0 1 1-1h6a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1zM9 14a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1V15a1 1 0 0 1 1-1h5zm7.293-5.293a1 1 0 0 1 1.414 1.414l-3 3a1 1 0 0 1-1.414 0l-3-3a1 1 0 1 1 1.414-1.414L11 11.586V5a1 1 0 1 1 2 0v6.586l1.293-1.293z" clip-rule="evenodd" />
            </svg>
            Filter
        </button>
            </div>
        </div>
    </div>
</div>

        <div class="container">
            <!-- Display time tracking entries here -->
            <table class="table">
            <thead>
            <table>
                <div class="mt-4 flex justify-end">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <div class="ml-4 flex">
                        {{-- <button class="btn btn-primary me-md-2" type="button">Export To Excel</button>
                        <button class="btn btn-primary" type="button">Export To Pdf</button> --}}
                        <a href="{{ route('timetrackings.export.excel') }}" class="btn btn-success">Export to Excel</a>
                        <a href="{{ route('timetrackings.export.pdf') }}" class="btn btn-primary">Export to PDF</a>
                    </div>
        </thead>
        <div class="container">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
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
        </div>
            </table>

    </div>
@endsection
