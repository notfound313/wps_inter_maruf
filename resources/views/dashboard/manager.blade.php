@extends('layouts.app')

@section('title', 'Directur Dashboard')

@section('header-title')
    Welcome, {{ $user->name }}!
@endsection

@section('content')
    <h2>Daftar Bawahan</h2>
    @if ($subordinates->isEmpty())
        <p>Tidak ada bawahan yang ditemukan.</p>
    @else
        <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subordinates as $hierarchy)
                    <tr>
                        <td>{{ $hierarchy->user->id }}</td>
                        <td>{{ $hierarchy->user->name }}</td>
                        <td>{{ $hierarchy->user->role->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <p>You are logged in as a Director. Here you can manage and oversee company operations.</p>
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
@endsection


