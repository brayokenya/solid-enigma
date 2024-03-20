<!-- resources/views/compensations/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Compensations</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compensations as $compensation)
                    <tr>
                        <td>{{ $compensation->casual_employee_id }}</td>
                        <td>{{ $compensation->amount }}</td>
                        <td>{{ $compensation->status }}</td>
                        <td>
                            @if ($compensation->status != 'approved')
                                <form action="{{ route('compensations.approve', $compensation->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
