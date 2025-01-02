@extends('layouts.master')
@push('title')
    <title>Contacts</title>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Contacts Details</h3>
                        <a href="{{ route('showall') }}" class="btn btn-success">Show All Contacts List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('contacts.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="aname" name="aname"
                                    placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="name">Phone Number:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Enter Address">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        @endsection
