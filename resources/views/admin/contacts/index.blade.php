@extends('guests.layouts.master')

@push('title')
    <title>Contact</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Display Admin Contacts Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>Contact Details</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($admincontacts as $admincontact)
                            <p><strong>Name:</strong> {{ ucfirst(Crypt::decrypt($admincontact->name)) }}</p>
                            <p><strong>Email:</strong> <a href="mailto:{{ Crypt::decrypt($admincontact->email) }}">{{ Crypt::decrypt($admincontact->email) }}</a> </p>
                            <p><strong>Phone:</strong><a href="tel:+{{ Crypt::decrypt($admincontact->phone) }}"> {{ Crypt::decrypt($admincontact->phone) }}</a> </p>
                            <p><strong>Address:</strong> {{ Crypt::decrypt($admincontact->address) }}</p>
                            <hr>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Contact Us</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ucontact.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="des" name="des" placeholder="Enter your message"></textarea>
                                @error('des')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
