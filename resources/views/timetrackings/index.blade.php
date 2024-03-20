<!-- resources/views/timetrackings/index.blade.php -->

@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <h1>Time Tracking Entries</h1>
        <!-- Display time tracking entries here -->
        <table class="table">
            <thead>
                <tr>
                    <th>From Date</th>  
                    <th>To Date</th>
                    <th>Code</th>
                    <th>Department</th>
                    <th>ID Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timetrackings as $timetracking)
                <tr>
                    <td>{{ $timetracking->employee->FromDate }}
                    <td>{{ $timetracking->employee->ToDate}}</td>
                    <td>{{ $timetracking->Code }}</td>
                    <td>{{ $timetracking->Department}}</td>
                    <td>{{ $timetracking->IDNumber }}</td>
                </tr>
                @endforeach
            </tbody> --}}
            <tbody>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Code</th>
                                <th>Department</th>
                                <th>ID Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timetrackings as $timetracking)
                            <tr>
                                <td>{{ $timetracking->employee->FromDate }}</td>
                                <td>{{ $timetracking->employee->ToDate }}</td>
                                <td>{{ $timetracking->Code }}</td>
                                <td>{{ $timetracking->Department }}</td>
                                <td>{{ $timetracking->IDNumber }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-6 col-md-4">
                    <!-- Sidebar content -->
                </div>
            </div>
            
        </table>
        <div class="container">
            <!-- Display time tracking entries here -->
            <table class="table">
            <thead>
            <table>
                {{-- <thead> --}}
                    {{-- <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>ID No.</th>
                        <th>Date</th>
                        <th>Branch</th>
                        <th>Shift</th>
                        <th>Clock-in Time</th>
                        <th>Clock-out Time</th>
                        <th>Worked Hours</th>
                    </tr> --}}
                {{-- </thead> --}}
                {{-- <tbody> --}}
                    {{-- URL BUTTONS FOR EXPORT PDF --}}
                    <div class="mt-6">
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
    </div>
@endsection
