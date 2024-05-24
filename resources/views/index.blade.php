@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Attendance</h1>

    <form action="{{ route('attendance.clockIn') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Clock In</button>
    </form>

    <form action="{{ route('attendance.clockOut') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-secondary">Clock Out</button>
    </form>

    <h2>Attendance Records</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->time_in }}</td>
                    <td>{{ $attendance->time_out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
