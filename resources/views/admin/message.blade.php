

@if(session('msgVendor'))
<div class="custom-alert-msg alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session('errorVendor'))
<div class="custom-alert-msg alert alert-danger">
    {{ session('error') }}
</div>
@endif