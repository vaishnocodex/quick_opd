@extends('website.master3') 
@section('content')
<main class="main pages mb-80" id="main-section">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <div class="breadcrumb-item d-inline-block">
                    <a href="{{route('welcome')}}"title="Home">
                        Home
                    </a>
                </div>
                <span></span>
                <div class="breadcrumb-item d-inline-block active">
                    <div itemprop="item">
                        Stores
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content pt-50">
        <div class="container">
            <div class="page-content pt-50">
                <div class="container">
                    <div class="archive-header-2 text-center">
                        <h1 class="display-2 mb-50">Hospitals</h1>
                        <div class="row">
                            <div class="col-lg-5 mx-auto">
                                <div class="sidebar-widget-2 widget_search mb-50">
                                    <div class="search-form form-group">
                                        <form  method="GET">
                                            <input class="form-control" name="q" required value=""
                                                type="text" placeholder="Search hospital...">
                                            <button type="submit"><i class="fi-rs-search"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               

                    <div class="row vendor-grid">
                      @foreach ($hospital as $item)
                        <div class="col-lg-3 col-md-6 col-12 col-sm-6">
                            <div class="vendor-wrap mb-40">
                                <div class="vendor-img-action-wrap">
                                    <div class="vendor-img">
                                        <a href="{{ route('hospital.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}">
                                            <img class="default-img" src="{{ asset('storage/hospital/').'/'.$item->image }}"
                                                alt="{{$item->name}}" />
                                        </a>
                                    </div>
                                </div>
                                <div class="vendor-content-wrap">
                                    <div class="d-flex justify-content-between align-items-end mb-30">
                                        <div class="overflow-hidden">
                                            {{-- <div class="product-category">
                                                <span class="text-muted">Since 2025</span>
                                            </div> --}}
                                            <h4 class="mb-5 text-truncate"><a href="{{ route('hospital.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}">{{$item->name}}</a></h4>
                                            <p>(14 Doctors)</p>
                                            {{-- <div class="product-rate-cover">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 57.985611510791%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (139)</span>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="vendor-info mb-30">
                                        <ul class="font-sm mb-20">
                                            <li>
                                                <span class="d-inline-block"><img
                                                        src="{{ asset('website') }}/assets/themes/nest/imgs/theme/icons/icon-location.svg"
                                                        alt="Address" /> <strong
                                                        class="d-inline-block ms-1 me-1">Address:</strong> {{substr($item->address, 0, 45)}}</span>
                                            </li>
                                            {{-- <li>
                                                <img src="themes/nest/imgs/theme/icons/icon-contact.svg"
                                                    alt="Phone" />
                                                <strong class="d-inline-block ms-1 me-1">Call Us:</strong>
                                                <span class="d-inline-block" dir="ltr">+14435141496</span>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    <a href="{{ route('hospital.all-doctor', ['id'=>Crypt::encrypt($item->id)]) }}" class="btn btn-xs">Book Now <i
                                            class="fi-rs-arrow-small-right"></i></a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                      
                    </div>


                </div>
            </div>

        </div>
    </div>
</main>

@endsection
