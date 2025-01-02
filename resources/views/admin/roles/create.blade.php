@extends('layouts.master')
@push('title')
    <title>Add new role</title>
@endpush
@section('content')
    <div class="container">
        <div class="card col-8">
            <div class="card-header">

                <h5 class="card-title text-muted">Create New Role</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="name" class="form-group">Enter Role Name</label>
                            <input type="text" name="name" id="name" class="form-group">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>

    </div>
@endsection
