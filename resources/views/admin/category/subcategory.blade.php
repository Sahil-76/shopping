@extends('layouts.master')

@push('title')
    <title>Add Sub Category</title>
@endpush

@section('content')
    <div class="container mt-4">

        <form action="{{ route('sub.category') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Enter Sub Category Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Sub Category Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                @php
                                    $name = Crypt::decrypt($category->name);
                                    $id=Crypt::encrypt($category->id)
                                @endphp
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Add Sub Category</button>
            </div>
        </form>
    </div>
@endsection
