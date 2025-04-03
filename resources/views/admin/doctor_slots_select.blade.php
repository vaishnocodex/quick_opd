@extends('admin.master') 
@section('content')

    <!-- Bootstrap Select CSS -->

    <div class="main-container">
      <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Doctor Slots</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                   
                    <hr>
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;"> Select Available Slots</div>
                                <form action="{{ route('admin-doctor-slots.saveSelection') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="doctor_id" value="{{ request()->doctor_id }}">
                                    <input type="hidden" name="date" value="{{ request()->date }}">
                                    <input type="hidden" name="start_time" value="{{ request()->start_time }}">
                                    <input type="hidden" name="end_time" value="{{ request()->end_time }}">
                                    <input type="hidden" name="slot_duration" value="{{ request()->slot_duration }}">
                                
                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <table class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Start Time -End Time </th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($slots as $slot)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="selected_slots[]" value="{{ $slot['start_time'] }}|{{ $slot['end_time'] }}">
                                                        </td>
                                                        <td>{{ $slot['start_time'] }} - {{ $slot['end_time'] }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($request->date)->format('d-M-Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                       
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Selected Slots</button>
                            </form>
                            </div>
                        </div>
                        </div>
                 
                </div>
            </div>
        </div>

    </div>
</div>


  
@endsection
