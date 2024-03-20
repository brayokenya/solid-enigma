{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Time Tracking Entries</h1>
        
        <!-- Display time tracking entries here -->
        <div class="mt-6">
            <a href="{{ route('timetrackings.export.excel') }}" class="btn btn-success">Export to Excel</a>
            <a href="{{ route('timetrackings.export.pdf') }}" class="btn btn-primary">Export to PDF</a>
        </div>

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
@endsection --}}


<!DOCTYPE html>
<html>
<head>
    <title>Time Tracking Entries</title>
    <!-- Add any necessary meta tags, styles, or scripts here -->
</head>
<body>
    <h1>Time Tracking Entries</h1>
    <table>
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
                    <td>{{ $timetracking->FromDate }}</td>
                    <td>{{ $timetracking->ToDate }}</td>
                    <td>{{ $timetracking->Code }}</td>
                    <td>{{ $timetracking->Department }}</td>
                    <td>{{ $timetracking->IDNumber }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
