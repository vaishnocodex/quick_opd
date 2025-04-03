@extends('admin.master')

@section('content')
<div class="container">
    <h2>Select Available Slots</h2>
    <form action="{{ route('doctor-slots.saveSelection') }}" method="POST">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ request()->doctor_id }}">
        <input type="hidden" name="date" value="{{ request()->date }}">
        <input type="hidden" name="start_time" value="{{ request()->start_time }}">
        <input type="hidden" name="end_time" value="{{ request()->end_time }}">
        <input type="hidden" name="slot_duration" value="{{ request()->slot_duration }}">
    
        <table class="table">
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slots as $slot)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_slots[]" value="{{ $slot['start_time'] }}|{{ $slot['end_time'] }}">
                        </td>
                        <td>{{ $slot['start_time'] }}</td>
                        <td>{{ $slot['end_time'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <button type="submit" class="btn btn-primary">Save Selected Slots</button>
    </form>
    
</div>
@endsection
