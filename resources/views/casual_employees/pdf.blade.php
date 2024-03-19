<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casual Employees PDF</title>
    <style>
        /* Add CSS styles for the PDF content */
    </style>
</head>
<body>
    <h1>Casual Employees PDF</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>id_number</th>
                <th>casual_code</th>
                <th>branch</th>
                <th>phone_number</th>
                <th>gender</th>
                <th>rate_per_day</th>
                <th>status</th>
                <!-- Add more table headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($casualEmployees as $employee)
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->id_number}}</td>
                <td>{{ $employee->casual_code }}</td>
                <td>{{ $employee->branch }}</td>
                <td>{{ $employee->phone_number}}</td>
                <td>{{ $employee->gender}}</td>
                <td>{{ $employee->department }}</td>
                <td>{{ $employee->rate_per_day }}</td>
                <td>{{ $employee->status }}</td>
     <!-- Add more table cells for other employee data -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
