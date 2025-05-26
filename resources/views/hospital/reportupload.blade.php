@extends('hospital.master')
@section('content')
@php
use Illuminate\Support\Facades\DB;
$reports = DB::table('report')->where('user_id',$id)->get();
@endphp
<!-- Bootstrap Select CSS -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.14/css/bootstrap-select.min.css">

<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">upload Report</li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @include('admin.message')
                    @if(!empty($staff_id))@endif
                    <form method="POST" action="{{ route('upload.report.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input name="appointment" type="hidden" value="{{ $id ?? '' }}" />
                        <input name="id" type="hidden" value="{{ $data->id ?? '' }}" />
                        {{-- Report File --}}
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6  col-12">
                            <div class="form-group">
                                <label for="report">Report File <span style="color:red">*</span></label>
                                <input type="file" class="form-control" name="report" id="report">
                                @if(!empty($data->report))
                                <a href="{{ asset('storage/reports/' . $data->report) }}" target="_blank">View Existing
                                    Report</a>
                                @endif
                            </div>
                        </div>


                        {{-- Status --}}
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6  col-12">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ (isset($data->status) && $data->status == 1) ? 'selected' : ''
                                        }}>Active</option>
                                    <option value="0" {{ (isset($data->status) && $data->status == 0) ? 'selected' : ''
                                        }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        {{-- Remarks --}}
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control" name="remarks" id="remarks"
                                    placeholder="Enter Remarks">{{ $data->remarks ?? old('remarks') }}</textarea>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <button type="submit" class="btn btn-primary">Save Report</button>
                        </div>
                    </form>



                </div>
            </div>

            <hr>

            <h4>Uploaded Reports</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Report File</th>
                        <th>Report Type</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Uploaded At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>
                            @if($report->report)
                            <a href="{{ asset('storage/reports/' . $report->report) }}" target="_blank">View Report</a>
                            @else
                            N/A
                            @endif
                        </td>
                        <td>{{ $report->report_type ?? 'N/A' }}</td>
                        <td>{{ $report->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>{{ $report->remarks ?? '-' }}</td>
                        <td>{{ $report->created_at }}</td>
                        <td>
                            <!-- Example action buttons -->
                            <a href="{{ route('upload.report.edit', $report->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('upload.report.delete', $report->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No reports found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>


        </div>

    </div>
</div>


<!-- Google Maps API: Replace YOUR_API_KEY with your actual key -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>


@endsection
