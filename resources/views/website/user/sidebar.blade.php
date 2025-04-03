<style>
    .form-group input {
    background: #fff;
    border: 1px solid #ececec;
    box-shadow: none;
    font-size: 16px;
    height: 42px;
    padding-left: 20px;
    width: 100%;
}

</style>
<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="password-change-tab" data-bs-toggle="tab" href="#password-change" role="tab" aria-controls="password-change" aria-selected="true"><i class="fi-rs-user mr-10"></i>Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.logout')}}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>