@extends('layouts.backend.app')
@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Withdraw Requests</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Withdraw Requests</h1>
                <p class="mb-0">Manage withdrawal requests and process payments.</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Request List</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-nowrap mb-0 rounded">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">Request Date</th>
                            <th class="border-0">User Name</th>
                            <th class="border-0">Amount</th>
                            <th class="border-0">Status</th>
                            <th class="border-0 rounded-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdraws as $withdraw)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $withdraw->created_at->format('d M Y H:i') }}</td>
                                <td>{{ $withdraw->name }}</td>
                                <td>Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $withdraw->status === 'pending' ? 'warning' : ($withdraw->status === 'transferred' ? 'success' : 'danger') }}">
                                        {{ ucfirst($withdraw->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('withdraw-request.show', $withdraw->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No withdrawal requests found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
