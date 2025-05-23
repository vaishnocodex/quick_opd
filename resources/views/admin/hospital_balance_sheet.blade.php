@extends('admin.master') 
@section('content')

<div class="main-container">
    <div class="page-header">
        <!-- Breadcrumb start -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{$page_heading}} </li>
        </ol>
        <!-- Breadcrumb end -->
    </div>
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                  
                    <div class="row gutters mt-4">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            @include('admin.message')
                            <div class="table-container">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <form method="post" action="{{ route('admin.hospital.balance-sheet-filter') }}">
                                        @csrf 
                                        <div class="row" style="display: flex;">
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fdate">From Date <span style="color:red">*</span></label>
                                                    <input type="date" required value="{{ $fdate }}" class="form-control" id="fdate" name="fdate" placeholder="Enter date" />
                                                </div>
                                            </div>
                            
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="tdate">To Date <span style="color:red">*</span></label>
                                                    <input type="date" required value="{{ $tdate }}" class="form-control" id="tdate" name="tdate" placeholder="Enter date" />
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" value="2" name="filter">
                            
                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6" style="margin-top: 22px;">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Filter</button>
                                                    @if(!empty($filter))
                                                        <a href="{{ route('admin.hospital.balance-sheet') }}" class="btn btn-warning">Clear Filter</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                             
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="table-container">
                                <div class="t-header" style="text-align: center; font-size: 18px;"> {{$page_heading}}</div>

                                <div class="table-responsive">
                                    <div id="copy-print-csv_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                  
                                        <table id="copy-print-csv" class="table custom-table dataTable no-footer" role="grid" aria-describedby="copy-print-csv_info">
                                            <thead>
                                                <tr role="row">
                                                   
                                                    <th>Action </th>
                                                    <th>Hospital Name</th>
                                                    <th>Mobile No.</th>
                                                    <th>Credit</th>
                                                    <th>Debit</th>
                                                    <th>Balance</th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i=0; @endphp @foreach ($data as $item)
                                                <tr>
                                                   <td> 
                                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.hospital.balance-sheet', ['id' => Crypt::encrypt($item->id)]) }}">View Ledger</a>
                                                   
                                                 </td>
                                                   <td>{{ $item->name }} </td>
                                                   <td>{{ $item->mobile_no  }}</td>
                                                   <td>@if($item->total_credit){{ $item->total_credit }} @else 0 @endif </td>
                                                   <td>@if($item->total_debit){{ $item->total_debit }} @else 0 @endif</td>
                                                   <td>@if( $item->total_credit||$item->total_debit){{ $item->total_credit-$item->total_debit }} @else 0 @endif</td>
                                                  
                                               </tr>
                                              
                                                @endforeach
                                               
                                            </tbody>
                                            <tfoot >
                                                <tr> 
                                                    <td colspan="1"></td>
                                                    <td colspan="2"></td>
                                                    <td colspan="1">Total Credit :  {{$Total_credit}} ₹</td>
                                                    <td colspan="1">Total Debit :  {{$Total_debit}} ₹</td>
                                                    <td colspan="1">Total Balance :  {{$Total_credit-$Total_debit}} ₹</td>
                                                   
                                                  
                                                   
    
                                                   </tr>
                                            </tfoot>
                                        </table>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                  
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
