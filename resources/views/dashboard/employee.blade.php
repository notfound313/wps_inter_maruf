@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('header-title')
    Welcome, {{ $user->name }}!
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Your Supervisor</h2>
            @if ($supervisor)
                <p>Supervisor Name: {{ $supervisor->name }}</p>
                <p>Role: {{ $supervisor->role->name }}</p>
            @else
                <p>You do not have a supervisor assigned.</p>
            @endif
            <p>You are logged in as a Staff member. Here you can view your assigned supervisor and other details.</p>
            <a href="{{ route('log/daily-log') }}" class="btn btn-primary">Create Daily Log</a>
        </div>
        <div class="card-footer text-end">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection