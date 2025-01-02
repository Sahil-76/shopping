@extends('layouts.master')

@push('title')
    <title>Edit Product</title>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <form action="{{ route('products.update', Crypt::encrypt($data->id)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="text" name="product_id" value=" {{ old('name', $data->product_id) }}"hidden>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $data->name) }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Product Status</label><br>
                            <input type="radio" name="status" id="status_active" value="active" {{ old('status', $data->products_status) == 'active' ? 'checked' : '' }} class="form-group @error('status') is-invalid @enderror">
                            <label for="status_active">Active</label>

                            <input type="radio" name="status" id="status_inactive" value="inactive" {{ old('status', $data->products_status) == 'inactive' ? 'checked' : '' }} class="form-group @error('status') is-invalid @enderror">
                            <label for="status_inactive">Inactive</label>

                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>{{ Crypt::decrypt($category->name) }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image">Product Image</label><br>
                            <img src="{{ Crypt::decrypt($data->image) }}" alt="Product Image" style="width: 5rem; margin-bottom: 10px;">
                            <input type="url" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" value="{{ Crypt::decrypt($data->image) }}">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">Product Link</label>
                            <input type="text" name="link" id="link" value="{{ old('link', Crypt::decrypt($data->link)) }}" class="form-control @error('link') is-invalid @enderror">
                            @error('link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Product Description</label><br>
                            <textarea name="description" id="description" cols="95" rows="5" class="form-control">{{ $data->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
