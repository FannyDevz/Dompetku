@extends('layouts.auth.app')
@section('title', 'Login')
@section('content')
    <div class="col-lg-5 col-12 align-items-center d-flex">
        <div id="auth-left">
{{--            <div class="auth-logo">--}}
{{--                <a href="index.html"><img src="./assets/compiled/svg/logo.svg" alt="Logo"></a>--}}
{{--            </div>--}}
            <h1 class="auth-title">@yield('title')</h1>
            <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-check form-check-lg d-flex align-items-end">
                    <input class="form-check-input me-2" type="checkbox" name="remember" value="" checked id="flexCheckDefault">
                    <label class="form-check-label text-gray-600" for="flexCheckDefault">
                        Keep me logged in
                    </label>
                </div>
                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
            </form>

            <div class="row mt-2">
                <div class="col-12">
                    @if($errors->has('username'))
                        <div class="alert alert-danger">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="text-center mt-5 text-lg fs-4">
                <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign
                        up</a>.</p>
            </div>

        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
@endsection
@section('custom-scripts')
@endsection
