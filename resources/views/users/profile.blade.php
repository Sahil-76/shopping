@extends('guests.layouts.master')
@push('title')
    <title>Profile</title>
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">Profile</h1>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $user->name }}'s Profile</h3>
                <a href="{{ route('edit.profile', Crypt::encrypt($user->id)) }}" class="btn btn-primary float-end">Edit Profile</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- User Info Section -->
                    <div class="col-6">
                        <h4>User Information</h4>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> {{ "Customer" }}</p>
                        <p><strong>Joined At:</strong> {{ $user->created_at->format('d M, Y') }}</p>
                        <p><strong>Last Updated:</strong> {{ $user->updated_at->format('d M, Y') }}</p>
                    </div>

                    <!-- User Address Section -->
                    <div class="col-6">
                        <h4>Address Information</h4>
                        @if (isset($user->address))
                            <p><strong>House No:</strong> {{ $user->address->house_no }}</p>
                            <p><strong>City:</strong> {{ $user->address->city }}</p>
                            <p><strong>State:</strong> {{ $user->address->state ?? 'N/A' }}</p>
                            <p><strong>Pin Code:</strong> {{ $user->address->pin_code }}</p>
                        @else
                            <p>No address information available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
