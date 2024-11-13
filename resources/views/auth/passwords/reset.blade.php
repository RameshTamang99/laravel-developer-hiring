@extends('layouts.main')

@section('content')
<form method="POST" action="{{ route('password.update') }}">
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
    <input id="email" type="hidden" class="form-control" name="email" value="{{ session('email') }}" readonly required>
    <div class="form-group">
        <label for="password">New Password</label>
        <input id="password" type="password" class="form-control" name="password" required>
        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>

    <button type="submit" class="btn btn-primary">Reset Password</button>
</form>

@endsection
