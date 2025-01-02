@extends('layouts.master')
@push('title')
    <title>Blogs</title>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Blogs</h3>
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary float-right">Create Blog</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="blogs">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Blog Title</th>
                                        <th>Blog Status</th>
                                        <th>Blog Description</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $blog)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Str::words(Crypt::decrypt($blog->title), 5) }}</td>
                                            @php
                                                $color = $blog->status === 'draft' ? 'color:red' : 'color:green';
                                            @endphp
                                            <td style="{{ $color }}">{{ ucfirst($blog->status) }}</td>
                                            <!--td>{{ Str::limit(Crypt::decrypt($blog->description), 50) }}</td-->
                                            <td>{{ Str::limit(strip_tags(Crypt::decrypt($blog->description)), 50) }}</td>

                                            <td>
                                                <img src="{{ Crypt::decrypt($blog->image) }}" alt="Blog Image"
                                                     style="width: 75px; height: 50px; aspect-ratio: 3/4; object-fit: cover; mix-blend-mode: multiply;">
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('blogs.edit', Crypt::encrypt($blog->id)) }}" class="btn btn-primary m-2">Edit</a>
                                                <a href="{{ route('blogs.show', Crypt::encrypt($blog->id)) }}" class="btn btn-info m-2">Details</a>
                                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="m-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ensure jQuery and DataTables scripts are included -->
    <script>
        $(document).ready(function() {
            $('#blogs').DataTable();
        });
    </script>
@endsection
