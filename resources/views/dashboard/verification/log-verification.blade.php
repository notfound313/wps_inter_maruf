@extends('layouts.app')

@section('title', 'Log Verification')

@section('header-title')
    Log Verification
@endsection

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Logs Pending Verification</h2>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('log-verification.index') && !request()->has('status') ? 'active' : '' }}" href="{{ route('log-verification.index') }}">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('log-verification.reject') ? 'active' : '' }}" href="{{ route('log-verification.reject') }}">Rejected</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('log-verification.accept') ? 'active' : '' }}" href="{{ route('log-verification.accept') }}">Accepted</a>
            </li>
        </ul>

        @if($logs->isEmpty())
            <div class="alert alert-info" role="alert">
                No logs verification.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->date }}</td>
                                <td>{{ $log->description }}</td>
                                <td>
                                    @if($log->status->name == 'Pending')
                                        <span class="badge bg-warning text-dark">{{ $log->status->name }}</span>
                                    @elseif($log->status->name == 'Reject')
                                        <span class="badge bg-danger">{{ $log->status->name }}</span>
                                    @elseif($log->status->name == 'Accept')
                                        <span class="badge bg-success">{{ $log->status->name }}</span>
                                    @else
                                        {{ $log->status->name }}
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('log-verification.update', $log) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select class="form-control form-control-sm" name="status_id" onchange="this.form.submit()">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}" {{ $log->status_id == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #343a40;
        color: white;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .badge-primary {
        background-color: #007bff;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }
    .badge-danger {
        background-color: #dc3545;
    }
    .badge-success {
        background-color: #28a745;
    }
</style>
@endpush