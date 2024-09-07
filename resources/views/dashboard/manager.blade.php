@extends('layouts.app')

@section('title', 'Directur Dashboard')

@section('header-title')
    Welcome, {{ $user->name }}!
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h2>Daftar Bawahan</h2>
            @if ($subordinates->isEmpty())
                <p>Tidak ada bawahan yang ditemukan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Role</th>
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
                </div>
            @endif
            <p>You are logged in as a Manager. Here you can manage and oversee company operations.</p>
            
            <a href="{{ route('log/daily-log') }}" class="btn btn-primary">Create Daily Log</a>
            <a href="{{ route('log-verification.index') }}" class="btn btn-success">Log Verification</a>
        </div>
        <div class="card-footer text-end">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection