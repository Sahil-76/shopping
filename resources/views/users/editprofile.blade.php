@extends('guests.layouts.master')
@push('title')
    <title>Edit Profile</title>
@endpush

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Profile</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <!-- Profile Update Card -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update your profile information</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.profile', ['id' => Crypt::encrypt($user->id)]) }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Change Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Leave blank to keep current password">
                            </div>

                            <div class="form-group mb-3">
                                <label for="join">Join At</label>
                                <input type="text" name="join" id="join" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($user->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y') }}"
                                    readonly>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Address Card -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ isset($user->address) ? 'Edit Your Address' : 'Add Your Address' }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.address', ['id' => Crypt::encrypt($user->id)]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="house_no">House No:</label>
                                <input type="text" name="house_no" id="house_no" class="form-control"
                                    value="{{ old('house_no', $user->address->house_no ?? '') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="pin_code">Pin Code</label>
                                <input type="text" name="pin_code" id="pin_code" class="form-control"
                                    value="{{ old('pin_code', $user->address->pin_code ?? '') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control"
                                    value="{{ old('city', $user->address->city ?? '') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="state">State</label>
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->name }}"
                                            {{ isset($user->address) && $user->address->state == $state->name ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="btn btn-primary">{{ isset($user->address) ? 'Update Address' : 'Add Address' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
