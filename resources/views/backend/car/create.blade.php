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
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Create New Car</h1>
                <p class="mb-0">Here you can create new car</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <select class="form-select" id="brand" name="brand" required>
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="police_number" class="form-label">Police Number</label>
                        <input type="text" class="form-control" id="police_number" name="police_number" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="tersedia">Available</option>
                            <option value="tidak tersedia">Unavailable</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rent_price" class="form-label">Rent Price</label>
                        <input type="number" class="form-control" id="rent_price" name="rent_price" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fuel" class="form-label">Fuel</label>
                        <select class="form-select" id="fuel" name="fuel" required>
                            <option value="petrol">Petrol</option>
                            <option value="diesel">Diesel</option>
                            <option value="electric">Electric</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="transmission" class="form-label">Transmission</label>
                        <select class="form-select" id="transmission" name="transmission" required>
                            <option value="manual">Manual</option>
                            <option value="automatic">Automatic</option>
                        </select>
                    </div>
                </div>

                <!-- Image upload -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Vehicle Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple
                            accept="image/*">
                        <small class="text-muted d-block mt-1">Click on an image to set it as primary</small>
                        <div id="image-preview" class="mt-2 d-flex flex-wrap gap-3"></div>
                        <input type="hidden" name="primary_image" id="primary_image">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .image-container {
            width: 150px;
            cursor: pointer;
            position: relative;
            border: 3px solid transparent;
            border-radius: 8px;
            overflow: hidden;
        }

        .image-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }

        .image-container.primary {
            border-color: #0d6efd;
        }

        .primary-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #0d6efd;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: none;
        }

        .image-container.primary .primary-badge {
            display: block;
        }

        .delete-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 4px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: rgba(220, 53, 69, 1);
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#images').on('change', function(e) {
                $('#image-preview').empty();

                $.each(e.target.files, function(i, file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const container = $('<div>')
                            .addClass('image-container')
                            .attr('data-index', i);

                        const img = $('<img>').attr('src', e.target.result);
                        const badge = $('<span>')
                            .addClass('primary-badge')
                            .text('Primary');
                        const deleteBtn = $('<button>')
                            .addClass('delete-btn')
                            .html('×')
                            .attr('type', 'button');

                        container.append(img).append(badge).append(deleteBtn);

                        // Set first image as primary by default
                        if (i === 0) {
                            container.addClass('primary');
                            $('#primary_image').val(0);
                        }

                        $('#image-preview').append(container);
                    }

                    reader.readAsDataURL(file);
                });
            });

            // Handle image selection
            $('#image-preview').on('click', '.image-container', function(e) {
                if (!$(e.target).hasClass('delete-btn')) {
                    $('.image-container').removeClass('primary');
                    $(this).addClass('primary');
                    $('#primary_image').val($(this).data('index'));
                }
            });

            // Handle delete button
            $('#image-preview').on('click', '.delete-btn', function(e) {
                e.stopPropagation();
                const container = $(this).closest('.image-container');
                const isPrimary = container.hasClass('primary');

                container.remove();

                // If we removed the primary image, set the first remaining image as primary
                if (isPrimary) {
                    const firstImage = $('.image-container').first();
                    if (firstImage.length) {
                        firstImage.addClass('primary');
                        $('#primary_image').val(firstImage.data('index'));
                    }
                }
            });
        });
    </script>
@endpush
