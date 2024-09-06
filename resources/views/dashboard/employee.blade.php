@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('header-title')
    Welcome, {{ $user->name }}!
@endsection

@section('content')
    <h2>Your Supervisor</h2>
    @if ($supervisor)
        <p>Supervisor Name: {{ $supervisor->name }}</p>
        <p>Role: {{ $supervisor->role->name }}</p>
    @else
        <p>You do not have a supervisor assigned.</p>
    @endif
    <p>You are logged in as a Staff member. Here you can view your assigned supervisor and other details.</p>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
@endsection
