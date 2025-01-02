@extends('layouts.master')
@push('title')
    <title>New Blog</title>
@endpush
@section('content')
    <div class="container">
        <h2>Add New Blog</h2>
        <form action="{{ route('blogs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Blog Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Blog Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group position-relative">
                <label for="image">Blog Image URL</label>
                <input type="url" class="form-control" id="image" name="image" required>

                <i class="fa fa-eye eye-icon" style="position: absolute; top: 50%; right: 10px; cursor: pointer;"
                    id="previewImageIcon"></i>
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Publish Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Blog</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>

    <!-- Modal to Preview Image -->
    <div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="previewImage" src="" alt="Image Preview" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
                $('#description').summernote();
                    });
                      </script>
   
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageInput = document.getElementById("image");
            const previewImageIcon = document.getElementById("previewImageIcon");
            const previewImage = document.getElementById("previewImage");

            previewImageIcon.addEventListener("click", function() {
                const imageUrl = imageInput.value;

                if (imageUrl) {
                    previewImage.src = imageUrl;

                    $('#imagePreviewModal').modal('show');
                } else {
                    alert("Please enter a valid image URL first.");
                }
            });
        });
    </script>
@endsection
