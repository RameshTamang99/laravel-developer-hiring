@extends('layouts.main')
@push('css')

<style>
    .form-control {
        border-radius: 20px;
        margin-bottom: 15px;
    }

    .btn-login {
        background-color: #E63946;
        border: none;
        color: white;
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: bold;
        width: 100%;
    }

    .remember-password {
        font-size: 14px;
        color: #0e0c0c;
    }

    .forgot-password {
        font-weight: 600;
        color: #eb1010;
    }

</style>

@endpush


@section('content')

    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px; margin-bottom: 20px;">
    <h2>User Login Page</h2>
    <p style="color: rgb(10, 9, 9);font-weight: 600;">Please enter your email and password to continue</p>

    @if(session('success'))
        <p style="color:red; font-weight: bold;">
            {{ session('success') }}
        </p>
    @endif

    @if(session('error'))
        <p style="color:red; font-weight: bold;">
            {{ session('error') }}
        </p>
    @endif

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <input name="email" type="email" class="form-control" placeholder="Email Address" required>
        </div>
        <div class="form-group">
            <input name="password" type="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="form-group d-flex justify-content-between align-items-center">
            <div class="form-check remember-password">
                <input type="checkbox" class="form-check-input" id="rememberPassword">
                <label class="form-check-label" for="rememberPassword">Remember Password</label>
            </div>
            <a href="{{ url('password/otp') }}" class="forgot-password">Forgot Password?</a>
        </div>
        <button type="submit" class="btn btn-login">Login</button>
    </form>
@endsection
