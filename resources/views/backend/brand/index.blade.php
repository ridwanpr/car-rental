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
                <li class="breadcrumb-item"><a href="javascript:void(0);">Manage Brand</a></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Manage Brand</h1>
                <p class="mb-0">Here is a list of all brand. You can add, edit or delete brand.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow mb-4">
                <div class="card-header">
                    <h2 class="h5 mb-0">Add Brand</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card border-0 shadow mb-4">
                <div class="card-header">
                    <h2 class="h5 mb-0">Brand List</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap mb-0 rounded" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="border-0 rounded-start">#</th>
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>
                                            <a href="{{ route('brand.edit', $brand->id) }}" data-id="{{ $brand->id }}"
                                                data-name="{{ $brand->name }}" class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#modal-edit-brand">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" x-bind:width="size"
                                                        x-bind:height="size" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" x-bind:stroke-width="stroke"
                                                        stroke-linecap="round" stroke-linejoin="round" width="16"
                                                        height="16" stroke-width="2">
                                                        <path d="M14 6l7 7l-4 4"></path>
                                                        <path
                                                            d="M5.828 18.172a2.828 2.828 0 0 0 4 0l10.586 -10.586a2 2 0 0 0 0 -2.829l-1.171 -1.171a2 2 0 0 0 -2.829 0l-10.586 10.586a2.828 2.828 0 0 0 0 4z">
                                                        </path>
                                                        <path d="M4 20l1.768 -1.768"></path>
                                                    </svg>
                                                </span>
                                            </a>
                                            <form action="{{ route('brand.destroy', $brand->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger delete-btn">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
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
        </div>
    </div>
@endsection
@push('modals')
    @include('backend.brand._modal-edit')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#modal-edit-brand').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const id = button.data('id');
                const name = button.data('name');

                const modal = $(this);
                modal.find('#name').val(name);

                const form = modal.find('#editBrandForm');
                form.attr('action', '/brand/' + id);
                form.attr('method', 'POST');
                form.append('<input type="hidden" name="_method" value="PUT">');
            });
        });
    </script>
@endpush