@extends('admin.master')

@section('content')
<div class="container">
    <h2>Doctor Slot Generation</h2>
    <form action="{{ route('doctor-slots.generate') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Doctor ID:</label>
            <input type="number" name="doctor_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Date:</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Start Time:</label>
            <input type="time" name="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label>End Time:</label>
            <input type="time" name="end_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Slot Duration (minutes):</label>
            <input type="number" name="slot_duration" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Generate Slots</button>
    </form>
</div>
@endsection
