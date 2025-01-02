@extends('layouts.master')
@push('title')
    <title>Admin Contact</title>
@endpush
@section('content')
    <div class="container">
        <a href="{{ route('contacts.create') }}" class=" btn btn-primary">Add New Contact</a>
        <div class="table-responsive mt-3">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">SR no.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst(Crypt::decrypt($contact->name)) }}</td>
                        <td>{{ ucfirst(Crypt::decrypt($contact->phone)) }}</td>
                        <td>{{ ucfirst(Crypt::decrypt($contact->email)) }}</td>
                        <td><a href="{{ route('contacts.edit',$contact->id) }}" class="btn btn-primary">Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
