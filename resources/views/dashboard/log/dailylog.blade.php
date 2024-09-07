@extends('layouts.app')

@section('title', 'Daily Log')

@section('header-title')
    Daily Log for {{ Auth::user()->name }}
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-4">Your Daily Logs</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('daily-log.store') }}" method="POST" class="mb-5 bg-light p-4 rounded-lg shadow">
            @csrf
            <div class="form-group">
                <label for="title" class="font-weight-bold text-primary">Title:</label>
                <input type="text" id="title" name="title" class="form-control border-primary rounded-lg shadow-sm" required>
            </div>
            
            <div class="form-group">
                <label for="start_date" class="font-weight-bold text-primary">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control border-primary rounded-lg shadow-sm" required>
            </div>
            
            <div class="form-group">
                <label for="end_date" class="font-weight-bold text-primary">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control border-primary rounded-lg shadow-sm" required>
            </div>
            
            <div class="form-group">
                <label for="description" class="font-weight-bold text-primary">Details:</label>
                <textarea id="description" name="description" rows="4" class="form-control border-primary rounded-lg shadow-sm" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary shadow-sm hover:bg-blue-600 transition duration-300 mt-3">Save Log</button>
        </form>

        <h3 class="mb-3">Previous Logs</h3>
        @if($logs->isEmpty())
            <p>No logs found.</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Details</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $log->title }}</td>
                                <td>{{ $log->start_date }}</td>
                                <td>{{ $log->end_date }}</td>
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
                                     <button class="btn btn-sm btn-primary edit-btn hover:bg-blue-600 transition duration-300" onclick="editLog({{ $log->id }})" {{ in_array($log->status->name, ['Accept', 'Pending']) ? 'disabled' : '' }}>Edit</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <script>        
        function editLog(logId) {            
            console.log('Edit log with ID:', logId);
        }
    </script>
@endsection