@extends('layouts.main')
@section('content')
    <img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 80px; margin-bottom: 20px;">
    <h2>  Welcome to UNO Test</h2>
    <a href="{{ route('admin.login') }}" style="color: seagreen;font-weight:bold">
        Admin Login
    </a>
    &nbsp;
    <a href="{{ route('login') }}" style="color: rgb(94, 94, 22);font-weight:bold">
        User Login
    </a>
@endsection
