<!-- resources/views/timetrackings/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Time Tracking Entries</h1>
        <!-- Display time tracking entries here -->
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Name</th>
                    <th>Clock In</th>
                    <th>Clock Out</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($timetrackings as $timetracking)
                <tr>
                    <td>{{ $timetracking->employee->first_name }} {{ $timetracking->employee->last_name }}</td>
                    <td>{{ $timetracking->clock_in }}</td>
                    <td>{{ $timetracking->clock_out }}</td>
                    <td>{{ $timetracking->date }}</td>
                </tr>
                @endforeach
            </tbody>
            {{-- URL BUTTONS FOR EXPORT PDF --}}
            <a href="{{ route('timetrackings.export.excel') }}" class="btn btn-success">Export to Excel</a>
            <a href="{{ route('timetrackings.export.pdf') }}" class="btn btn-primary">Export to PDF</a>

        </table>
        <div class="container">
            <h1>Time Tracking Entries</h1>
            <!-- Display time tracking entries here -->
            <table class="table">
            <thead>
            <h1>Time Tracking Report</h1>
            <table>
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>ID No.</th>
                        <th>Date</th>
                        <th>Branch</th>
                        <th>Shift</th>
                        <th>Clock-in Time</th>
                        <th>Clock-out Time</th>
                        <th>Worked Hours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timetrackings as $timetracking)
                    <tr>
                        <td>{{ $timetracking->employee->casual_code }}</td>
                        <td>{{ $timetracking->employee->first_name }} {{ $timetracking->employee->last_name }}</td>
                        <td>{{ $timetracking->employee->id_number }}</td>
                        <td>{{ $timetracking->date }}</td>
                        <td>{{ $timetracking->employee->branch }}</td>
                        <td>{{ $timetracking->shift }}</td>
                        <td>{{ $timetracking->clock_in }}</td>
                        <td>{{ $timetracking->clock_out }}</td>
                        <td>{{ $timetracking->worked_hours }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
