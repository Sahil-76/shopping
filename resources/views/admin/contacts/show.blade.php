@extends('layouts.master')

@push('title')
    <title>Contact Details</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Display Contact Details -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h3>Users Contact Details</h3>
                    </div>
                    <div class="card-body">
                            <div class="row">
                        @if($contact->isEmpty())
                            <p>No contact information found.</p>
                        @else
                            @foreach ($contact as $item)
                                <div class="col-6 mb-3">
                                    <p><strong>Sr No:</strong> {{ $loop->iteration }}</p>
                                    <p><strong>Name:</strong> {{ Crypt::decrypt($item->name) }}</p>
                                    <p><strong>Email:</strong><a href="mailto:{{ Crypt::decrypt($item->email) }}"> {{ Crypt::decrypt($item->email) }}</a></p>
                                    <p><strong>Phone:</strong><a href="tel:{{ Crypt::decrypt($item->phone_number)}}"> {{ Crypt::decrypt($item->phone_number) }}</a></p>
                                    <p><strong>Message:</strong> {{ Crypt::decrypt($item->message) }}</p>
                                    <hr>
                                </div>

                            @endforeach
                        @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
