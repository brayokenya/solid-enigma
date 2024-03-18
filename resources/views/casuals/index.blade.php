@extends('layouts.app')

@section('content')
    <!-- Filter form -->
    <form action="{{ route('casuals.filter') }}" method="GET">
        <input type="text" name="name" placeholder="Search by name">
        <select name="department">
            <option value="">All Departments</option>
            <!-- Add options for departments -->
        </select>
        <select name="status">
            <option value="">All Statuses</option>
            <!-- Add options for statuses -->
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Casual employees list -->
    <div class="casuals-list">
        <!-- Display casual employees here -->
    </div>
@endsection
