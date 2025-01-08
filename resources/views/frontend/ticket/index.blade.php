@extends('layouts.frontend.app')
@section('content')
    <div class="container py-5 min-vh-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tickets</h1>
            <a href="{{ route('ticket.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Create Ticket
            </a>
        </div>

        <!-- Navigation -->
        @include('layouts.frontend.components.nav')

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">#</th>
                                <th class="border-0">Subject</th>
                                <th class="border-0">Status</th>
                                <th class="border-0">Created At</th>
                                <th class="border-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>
                                        @if ($ticket->status == 'open')
                                            <span class="badge bg-success">Open</span>
                                        @elseif ($ticket->status == 'in_progress')
                                            <span class="badge bg-warning text-dark">In Progress</span>
                                        @elseif ($ticket->status == 'closed')
                                            <span class="badge bg-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('ticket.show', $ticket->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
