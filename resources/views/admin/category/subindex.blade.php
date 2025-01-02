@extends('layouts.master')

@push('title')
    <title>Subcategories List</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">

            <a href="{{ route('sub.category') }}" class="btn btn-success">Add New Sub Categroy</a>
        </div>
        <table class="table table-bordered table-striped" id="subcategory">
            <h2>Subcategories List</h2>
            <thead>
                <tr class="text-center">
                    <th>Subcategory ID</th>
                    <th>Subcategory Name</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $subcategory)
                    @php
                        $subcategory_name = Crypt::decrypt($subcategory->name);
                        $category_name = Crypt::decrypt($subcategory->categories->name);
                    @endphp
                    <tr>
                        <td>{{ $subcategory->id }}</td>
                        <td>{{ ucfirst($subcategory_name) }}</td>
                        <td>{{ ucfirst($category_name) ?? 'No Category' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#subcategory').DataTable({
                "responsive": true,
                "columnDefs": [{
                        "width": "20%",
                        "targets": 0
                    },
                    {
                        "width": "40%",
                        "targets": 1
                    },
                    {
                        "width": "40%",
                        "targets": 2
                    }
                ],
                "pagingType": "simple_numbers",
                "autoWidth": false
            });

        });
    </script>
@endsection
