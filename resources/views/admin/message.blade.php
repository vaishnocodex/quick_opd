
@if (Session::has('msgVendor'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ Session::get('msgVendor') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
@if (Session::has('errorVendor'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ Session::get('errorVendor') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

@enderror
