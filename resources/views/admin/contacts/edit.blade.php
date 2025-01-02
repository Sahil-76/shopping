@extends('layouts.master')

@push('title')
    <title>Edit Contact</title>
@endpush

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Contact</h1>
        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', ucfirst(Crypt::decrypt($contact->name))) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', Crypt::decrypt($contact->email)) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    value="{{ old('phone', Crypt::decrypt($contact->phone)) }}" required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="message">Address:</label>
                <textarea name="address" id="address" class="form-control" rows="4" required>{{ old('address', Crypt::decrypt($contact->address)) }}</textarea>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Contact</button>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
