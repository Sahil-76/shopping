@extends('layouts.master')

@push('title')
    <title>Brands</title>
@endpush

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Brand List</h5>
                <a href="{{ route('brands.create') }}" class="btn btn-success">Add New Brand</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sr No.</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucfirst(Crypt::decrypt($brand->name)) }}</td>
                                    <td>
                                        @if($brand->category) <!-- Check if the category exists -->
                                            {{ ucfirst(Crypt::decrypt($brand->category->name)) }}
                                        @else
                                            No Category Assigned
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($brand->created_at)->format('d-M-Y h:i A') }}</td>
                                    <td>
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
@endsection
