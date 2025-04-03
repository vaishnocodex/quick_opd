<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Schedule</title>
</head>
<body>

    <h2>Doctor Weekly Schedule</h2>
    
    <form action="{{ url('/doctor-schedules') }}" method="POST">
        @csrf
        <input type="hidden" name="doctor_id" value="{{ $doctor_id }}"> <!-- Doctor ID -->

        <table border="1">
            <tr>
                <th>Date</th>
                <th>Status</th>
                <th>Start Time</th>
                <th>End Time</th>
            </tr>
            @foreach ($dates as $index => $date)
                @php
                    $existingData = $existingSchedule[$date] ?? null;
                    $disabled = now()->toDateString() > $date ? 'disabled' : ''; // Disable past dates
                @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}</td>
                    <input type="hidden" name="slots[{{ $index }}][date]" value="{{ $date }}">

                    <td>
                        <select name="slots[{{ $index }}][status]" {{ $disabled }}>
                            <option value="available" {{ $existingData && $existingData->status === 'available' ? 'selected' : '' }}>Available</option>
                            <option value="unavailable" {{ $existingData && $existingData->status === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                        </select>
                    </td>

                    <td><input type="time" name="slots[{{ $index }}][start_time]" value="{{ $existingData->start_time ?? '' }}" {{ $disabled }}></td>

                    <td><input type="time" name="slots[{{ $index }}][end_time]" value="{{ $existingData->end_time ?? '' }}" {{ $disabled }}></td>
                </tr>
            @endforeach
        </table>

        <button type="submit">Save Schedule</button>
    </form>

</body>
</html>
