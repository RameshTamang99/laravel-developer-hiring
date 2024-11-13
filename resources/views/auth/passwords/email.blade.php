@extends('layouts.main')
@section('content')
<div class="card-body">
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
    <form method="POST" action="{{ route('password.send.otp') }}">
        @csrf
        <div class="form-group">
            <label for="email" style="color: red">Enter You Valid Email To send otp</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Send OTP</button>
    </form>
@endsection
