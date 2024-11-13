@extends('layouts.main')
@section('content')
<form method="POST" action="{{ route('password.verifyOtp.submit') }}">
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
    @csrf
    <div class="form-group">
        <label for="otp">Enter OTP</label>
        <a href="{{ route('password.otp.form') }}" style="float:right">Send OTP Again</a>
        <input id="otp" type="text" class="form-control" name="otp" required autofocus>
        @error('error')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Verify OTP</button>
</form>
@endsection
