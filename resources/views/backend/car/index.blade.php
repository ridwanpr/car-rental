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
                <li class="breadcrumb-item"><a href="javascript:void(0);">Manage Cars</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Manage Cars</h1>
                <p class="mb-0">Here is a list of all car. You can add, edit or delete car.</p>
            </div>
            <div>
                <a href="{{ route('car.create') }}" class="btn btn-gray-800 d-inline-flex align-items-center me-2">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Add Car
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-header">
            <h2 class="h5 mb-0">Car List</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="border-0 rounded-start">#</th>
                            <th class="border-0">Image</th>
                            <th class="border-0">Brand, Model</th>
                            <th class="border-0">Year</th>
                            <th class="border-0">Police Number</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Rent Price</th>
                            <th class="border-0">Capacity</th>
                            <th class="border-0">Fuel, Transmission</th>
                            <th class="border-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                            <tr class="align-middle">
                                <td class="border-0">{{ $loop->iteration }}</td>
                                <td class="border-0">
                                    <img src="{{ asset('storage/cars/' . $car->images->firstWhere('is_primary', 1)->image) }}"
                                        width="50" height="50" class="rounded img-thumbnail object-fit-cover">
                                </td>
                                <td class="border-0">{{ $car->brand->name }}, {{ $car->model }}</td>
                                <td class="border-0">{{ $car->tahun }}</td>
                                <td class="border-0">{{ $car->plat_nomor }}</td>
                                <td class="border-0">
                                    @if ($car->status == 'tersedia')
                                        <span class="badge bg-success">Available</span>
                                    @elseif ($car->status == 'tidak tersedia')
                                        <span class="badge bg-danger">Unavailable</span>
                                    @else
                                        <span class="badge bg-warning">Rented</span>
                                    @endif
                                </td>
                                <td class="border-0">{{ number_format($car->harga_sewa, 0, ',', '.') }}</td>
                                <td class="border-0">{{ $car->jumlah_kursi }} Person</td>
                                <td class="border-0 text-capitalize">{{ $car->bahan_bakar }}, {{ $car->transmission }}</td>
                                <td class="border-0">
                                    <a href="{{ route('car.edit', $car->id) }}" class="btn btn-sm btn-primary">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                                                x-bind:height="size" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" x-bind:stroke-width="stroke" stroke-linecap="round"
                                                stroke-linejoin="round" width="16" height="16" stroke-width="2">
                                                <path d="M14 6l7 7l-4 4"></path>
                                                <path
                                                    d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.586 -10.586a2 2 0 0 0 0 -2.829l-1.171 -1.171a2 2 0 0 0 -2.829 0l-10.586 10.586a2.828 2.828 0 0 0 0 4z">
                                                </path>
                                                <path d="M4 20l1.768 -1.768"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <form action="{{ route('car.destroy', $car->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M4 7l16 0"></path>
                                                    <path d="M10 11l0 6"></path>
                                                    <path d="M14 11l0 6"></path>
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
