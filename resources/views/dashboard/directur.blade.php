@extends('layouts.app')

@section('title', 'Directur Dashboard')

@section('header-title')
    Welcome, {{ $user->name }}!
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Daftar Bawahan</h2>           
        </div>
        <div class="card-body">
            @if ($subordinates->isEmpty())
                <p>Tidak ada bawahan yang ditemukan.</p>
            @else
                <table class="table table-hover table-striped table-bordered">
                    <thead class="thead-light" style="background-color: #f8f9fa;">
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
            <div id='calendar'></div>            
            <p>You are logged in as a Director. Here you can manage and oversee company operations.</p>
            <a href="{{ route('log-verification.index') }}" class="btn btn-primary">Log Verification</a>
        </div>
        <div class="card-footer text-end">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($formattedLogs),
                editable: true,
                selectable: true,
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);                   
                },
            });

            calendar.render();
        });
    </script>
@endsection