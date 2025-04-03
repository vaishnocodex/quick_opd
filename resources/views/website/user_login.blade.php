@extends('website.master3') 
@section('content')

<style>
    .input-password-toggle {
        position: absolute;
        right: 0;
        top: 0;
        cursor: pointer;
        padding: 10px 15px;
        z-index: 9;
    }

    input[data-bb-password]:valid,
    input[data-bb-password].is-valid {
        background-image: unset;
    }

    body[dir="rtl"] .input-password-toggle {
        right: unset;
        left: 0;
    }
</style>
<link media="all" type="text/css" rel="stylesheet" href="{{ asset('website') }}/assets/vendor/core/plugins/ecommerce/css/front-auth7897.css?v=1.25.2">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<main class="main" id="main-section">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <div class="breadcrumb-item d-inline-block">
                    <a href="{{route('welcome')}}"title="Home"> Home </a>
                </div>
                <span></span>
                <div class="breadcrumb-item d-inline-block active">
                    <div itemprop="item">
                        Login
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content pt-50 pb-150">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10">
                    <div class="auth-card auth-card__horizontal row">
                        <div class="col-md-6 auth-card__left">
                            <img src="{{ asset('website') }}/login_page.jpg" data-bb-lazy="true" class="auth-card__banner"
                                loading="lazy" alt="Login to your account">
                        </div>

                        <div class="col-md-6 auth-card__right">
                            <div class="auth-card__header">
                                <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                    <div class="auth-card__header-icon bg-white p-3 rounded">
                                        <svg class="icon text-primary svg-icon-ti-ti-lock"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                            <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="auth-card__header-title fs-4 mb-1">Login to your account</h3>
                                        <p class="auth-card__header-description text-muted">Your personal data will be
                                            used to support your experience throughout this website, to manage access to
                                            your account.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="auth-card__body">
                                @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                                <form method="POST" action="{{route('user.do-login')}}" bannerDirection="horizontal">
                                    @csrf
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="email"> Email</label>

                                        <div class="position-relative"><span
                                                class="auth-input-icon input-group-text"><svg
                                                    class="icon  svg-icon-ti-ti-mail" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                                    <path d="M3 7l9 6l9 -6" />
                                                </svg></span>

                                            <input class="form-control ps-5" data-counter="60" placeholder="Email address" name="email" type="email"  id="email" required>

                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label class="form-label" for="password"> Password </label>

                                        <div class="position-relative"><span
                                                class="auth-input-icon input-group-text"><svg
                                                    class="icon  svg-icon-ti-ti-lock" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                                </svg></span>

                                            <div class="input-group">
                                                <input type="password" name="password" id="password" value=""  class="form-control ps-5" data-counter="250" placeholder="Password" data-bb-password required>
                                                <span class="input-password-toggle" data-bb-toggle-password>
                                                    <svg class="icon  svg-icon-ti-ti-eye"
                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                        <path
                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                    </svg> </span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row g-0 mb-3">

                                        <div class="col-6">
                                            <input type="hidden" name="remember" value="0">
                                            <label class="form-check">
                                                <input type="checkbox" id="remember_dc3c99bb4e249a95567a2bf7d5f327ed"  name="remember" class="form-check-input" value="1">

                                                <span class="form-check-label"> Remember me </span>  </label>

                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="text-decoration-underline">Forgot password?</a>
                                        </div>

                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-auth-submit" type="submit">Login<svg
                                                class="icon  svg-icon-ti-ti-arrow-narrow-right"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l14 0" />
                                                <path d="M15 16l4 -4" />
                                                <path d="M15 8l4 4" /></svg></button>
                                    </div>
                                    <div class="mt-3 text-center"> Don&#039;t have an account?
                                        <a href="{{route('register.user')}}" class="ms-1 text-decoration-underline">Register now</a>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>


<script>
    window.addEventListener('load', function() {
        document.querySelectorAll('[data-bb-toggle-password]').forEach(button => {
            button.addEventListener('click', () => {
                const passwordField = button.parentElement.querySelector('[data-bb-password]');

                if (passwordField.getAttribute('type') === 'password') {
                    passwordField.setAttribute('type', 'text');
                    button.innerHTML = `<svg class="icon  svg-icon-ti-ti-eye-off"
xmlns="http://www.w3.org/2000/svg"
width="24"
height="24"
viewBox="0 0 24 24"
fill="none"
stroke="currentColor"
stroke-width="2"
stroke-linecap="round"
stroke-linejoin="round"
>
<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
<path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
<path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
<path d="M3 3l18 18" />
</svg>`;
                } else {
                    passwordField.setAttribute('type', 'password');
                    button.innerHTML = `<svg class="icon  svg-icon-ti-ti-eye"
xmlns="http://www.w3.org/2000/svg"
width="24"
height="24"
viewBox="0 0 24 24"
fill="none"
stroke="currentColor"
stroke-width="2"
stroke-linecap="round"
stroke-linejoin="round"
>
<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
</svg>`;
                }
            });
        });
    });
</script>

@endsection