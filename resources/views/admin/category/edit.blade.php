@extends('layouts.master')

@push('title')
    <title>Edit Category</title>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.update', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', Crypt::decrypt($category->name)) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!--div class="mb-3">
                        <label for="brand" class="form-label">Select Brand</label>
                        <select name="brand_id" id="brand" class="form-control select-2">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $category->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ ucfirst(Crypt::decrypt($brand->name)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div-->

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
