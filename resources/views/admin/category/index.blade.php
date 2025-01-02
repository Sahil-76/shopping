@extends('layouts.master')

@push('title')
    <title>Roles</title>
@endpush

@section('content')
    <div class="container">
        <div class="table-responsive">
            <a href="{{ route('categories.create') }}" class="btn btn-success">Add New Categories</a>
            <table class="table" id="roles">
                <thead>
                    <tr>
                        <th scope="col">Sr No.</th>
                        <th scope="col">Name</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Sub Categories</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $role)
                        @php
                            $name = Crypt::decrypt($role->name);
                            $sub_category_names =
                                $role->subcategory
                                    ->map(function ($subcategory) {
                                        return ucfirst(Crypt::decrypt($subcategory->name));
                                    })
                                    ->implode(', ') ?:
                                'No Subcategory Added Yet!';
                        @endphp

                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ ucfirst($name) }}</td>

                            @php
                                // Handling brand names
                                $brand_names = $role->brands->isNotEmpty()
                                    ? $role->brands
                                        ->map(function ($bname) {
                                            return ucfirst(Crypt::decrypt($bname->name));
                                        })
                                        ->implode(', ')
                                    : 'No Brand Added Yet!';
                            @endphp

                            <td class="{{ $role->brands->isNotEmpty() ? '' : 'text-danger' }}">
                               <b> {{ $brand_names }}</b>
                            </td>

                            <td class="{{ $role->subcategory->isNotEmpty() ? '' :"text-danger" }}">
                               <b>{{ $sub_category_names }}</b>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($role->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('categories.destroy', $role->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#roles').DataTable({
                // Add any DataTable options you need
            });
        });
    </script>
@endsection
