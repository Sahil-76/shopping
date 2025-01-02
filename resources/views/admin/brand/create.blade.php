@extends('layouts.master')
@push('title')
    <title>Add Brand</title>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Brand</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('brands.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="name">Enter Brand Name</label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="Enter Brand Name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col">
                                    <label for="name" class="form-group">Select Brand Name</label>
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">Select Brnad Name</option>
                                        @foreach ($category as $brand)
                                            <option value="{{ $brand->id }}">{{ Crypt::decrypt($brand->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>


                            <br>
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
