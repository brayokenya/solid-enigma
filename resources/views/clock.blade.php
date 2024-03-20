<!-- resources/views/clock.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clock In/Out</title>
</head>
<body>
    <h1>Clock In/Out</h1>

    <form action="{{ route('clock.in') }}" method="post">
        @csrf
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" id="employee_id">
        <button type="submit">Clock In</button>
    </form>

    <form action="{{ route('clock.out') }}" method="post">
        @csrf
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" id="employee_id">
        <button type="submit">Clock Out</button>
    </form>
</body>
</html>
