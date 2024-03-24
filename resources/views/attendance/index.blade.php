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
                <!-- Add input fields for ID Number and other filter options -->
            </div>
            <div class="mt-4">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Apply Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Display time tracking entries here -->
    <!-- Table Section -->
</div>

@endsection
