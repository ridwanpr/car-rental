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
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Car</h1>
                <p class="mb-0">Here you can edit car</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <select class="form-select" id="brand" name="brand" required>
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected($brand->id == $car->brand_id)>{{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required
                            value="{{ $car->model }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" required
                            value="{{ $car->tahun }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="police_number" class="form-label">Police Number</label>
                        <input type="text" class="form-control" id="police_number" name="police_number" required
                            value="{{ $car->plat_nomor }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="tersedia" @selected($car->status == 'tersedia')>Available</option>
                            <option value="tidak tersedia" @selected($car->status == 'tidak tersedia')>Unavailable</option>
                            <option value="disewa" @selected($car->status == 'disewa')>Rented</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rent_price" class="form-label">Rent Price</label>
                        <input type="number" class="form-control" id="rent_price" name="rent_price" required
                            value="{{ $car->harga_sewa }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="capacity" class="form-label">Capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required
                            value="{{ $car->jumlah_kursi }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fuel" class="form-label">Fuel</label>
                        <select class="form-select" id="fuel" name="fuel" required>
                            <option value="petrol" @selected($car->fuel == 'petrol')>Petrol</option>
                            <option value="diesel" @selected($car->fuel == 'diesel')>Diesel</option>
                            <option value="electric" @selected($car->fuel == 'electric')>Electric</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="transmission" class="form-label">Transmission</label>
                        <select class="form-select" id="transmission" name="transmission" required>
                            <option value="manual" @selected($car->transmisi == 'manual')>Manual</option>
                            <option value="automatic" @selected($car->transmisi == 'automatic')>Automatic</option>
                        </select>
                    </div>
                </div>

                <!-- Image upload -->
                <!-- Replace the existing image upload section with this -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label class="form-label">Vehicle Images</label>
                        <input type="file" class="form-control" id="images" name="new_images[]" multiple
                            accept="image/*">
                        <small class="text-muted d-block mt-1">Click on an image to set it as primary</small>

                        <!-- Existing Images -->
                        <div id="existing-images" class="mt-2 d-flex flex-wrap gap-3">
                            @foreach ($car->images as $image)
                                <div class="image-container {{ $image->is_primary ? 'primary' : '' }}"
                                    data-image-id="{{ $image->id }}">
                                    <img src="{{ asset('storage/cars/' . $image->image) }}" alt="Car Image">
                                    <span class="primary-badge">Primary</span>
                                    <button type="button" class="btn-delete"
                                        data-image-id="{{ $image->id }}">×</button>
                                    <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                </div>
                            @endforeach
                        </div>

                        <!-- New Images Preview -->
                        <div id="image-preview" class="mt-2 d-flex flex-wrap gap-3"></div>

                        <input type="hidden" name="primary_image_id" id="primary_image_id"
                            value="{{ $car->images->where('is_primary', true)->first()->id ?? '' }}">
                        <input type="hidden" name="deleted_images" id="deleted_images">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('car.index') }}" class="btn btn-link">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
    @include('backend.car._style')
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            // Handle new image uploads
            $('#images').on('change', function(e) {
                $.each(e.target.files, function(i, file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const container = $('<div>')
                            .addClass('image-container')
                            .addClass('new-image')
                            .attr('data-index', i);

                        const img = $('<img>').attr('src', e.target.result);
                        const badge = $('<span>')
                            .addClass('primary-badge')
                            .text('Primary');
                        const deleteBtn = $('<button>')
                            .addClass('btn-delete')
                            .html('×')
                            .attr('type', 'button');

                        container.append(img).append(badge).append(deleteBtn);
                        $('#image-preview').append(container);
                    }

                    reader.readAsDataURL(file);
                });
            });

            // Handle image selection (both existing and new)
            $('.col-12').on('click', '.image-container', function(e) {
                if (!$(e.target).hasClass('btn-delete')) {
                    $('.image-container').removeClass('primary');
                    $(this).addClass('primary');

                    // Update primary image ID
                    const imageId = $(this).data('image-id');
                    const isNew = $(this).hasClass('new-image');

                    if (isNew) {
                        $('#primary_image_id').val('new_' + $(this).data('index'));
                    } else {
                        $('#primary_image_id').val(imageId);
                    }
                }
            });

            // Handle delete button for existing images
            let deletedImages = [];

            $('.col-12').on('click', '.btn-delete', function(e) {
                e.stopPropagation();
                const container = $(this).closest('.image-container');
                const imageId = container.data('image-id');

                if (imageId) { // Existing image
                    deletedImages.push(imageId);
                    $('#deleted_images').val(JSON.stringify(deletedImages));

                    // If deleted image was primary, set first remaining image as primary
                    if (container.hasClass('primary')) {
                        const firstRemaining = $('.image-container').not(container).first();
                        if (firstRemaining.length) {
                            firstRemaining.addClass('primary');
                            $('#primary_image_id').val(firstRemaining.data('image-id') || 'new_' +
                                firstRemaining.data('index'));
                        }
                    }
                }

                container.remove();
            });
        });
    </script>
@endpush
