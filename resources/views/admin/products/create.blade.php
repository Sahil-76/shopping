@extends('layouts.master')
@push('title')
    <title>
        Add New Product</title>
@endpush

@section('content')
    @php
        $productId = 'ma-' . rand(1000, 9999);
    @endphp
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-muted">Create New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="product_id" class="form-label">Product ID:</label>
                            <input type="text" name="product_id" id="product_id" class="form-control"
                                value="{{ $productId }}" readonly>
                        </div>
                        <div class="col">
                            <label for="name" class="form-label">Enter Product Name</label>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                    </div>


                    <div class="row md-3">
                        <div class="col">
                            <label for="name" class="form-label">Enter Product Image</label>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="input-group">
                                <input type="url" name="image" id="image" class="form-control"
                                    placeholder="Enter image URL">
                                <span class="input-group-append" id="eyeIcon" style="display: none;">
                                    <button class="btn btn-outline-secondary" type="button" id="showImage"
                                        data-toggle="modal" data-target="#imageModal">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </span>
                            </div>

                        </div>
                        <div class="col">
                            <label for="name" class="form-label">Enter Product Buy Link</label>
                            @error('link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="url" name="link" id="link" class="form-control">
                        </div>

                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="category_id" class="form-label">Select Category</label>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option value="">Select Category</option>
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}">{{ Crypt::decrypt($cate->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Product Status:</label> @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <input type="radio" name="status" id="active" value="active">
                            <label for="active">Active</label>
                            <input type="radio" name="status" id="inactive" value="inactive">
                            <label for="inactive">Inactive</label>

                        </div>

                    </div>

                    <div class="row mb-3">

                        <div class="col mb-3">
                            <label for="description">Product Description</label>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <br>
                            <textarea name="description" id="desc" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Product Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalImagePreview" src="" alt="Image Preview" style="width: 100%;" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function(){
        $('#desc').summernote();
    });
    </script>
  
    <script>
        $(document).ready(function() {
            // Show or hide eye icon based on input value
            $('#image').on('input', function() {
                var imageUrl = $(this).val();
                if (imageUrl) {
                    $('#eyeIcon').show(); // Show the eye icon if there's a URL
                } else {
                    $('#eyeIcon').hide(); // Hide the eye icon if the URL is empty
                }
            });

            // Handle click event for showing image in modal
            $('#showImage').click(function() {
                var imageUrl = $('#image').val();
                if (imageUrl) {
                    $('#modalImagePreview').attr('src', imageUrl); // Set the src of the modal image
                } else {
                    $('#modalImagePreview').attr('src', ''); // Clear the image if no URL is provided
                }
            });
        });
    </script>
@endsection
