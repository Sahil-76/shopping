@extends('guests.layouts.master')

@push('title')
    <title>Blogs</title>
@endpush

@section('content')
    <div class="container">
        <h2>Blogs</h2>

        @if ($blogs->isEmpty())
            <div class="alert alert-warning" role="alert">
                No blogs found.
            </div>
        @else
            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ Crypt::decrypt($blog->image) }}" class="card-img-top" alt="Blog Image" height="200px">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Title : {{ Str::limit(Crypt::decrypt($blog->title),20) }}</strong></h5>
                                <!--p class="card-text">{!! Str::limit(Crypt::decrypt($blog->description), 100) !!}</p-->
                                <p class="card-text">{{ Str::limit(strip_tags(Crypt::decrypt($blog->description)), 50) }}</p>

                                <p class="card-text">
                                 <small class="text-bold">
                                      Published By: {{$blog->users->name}}
                                    </small>
                                    <br>
                                    <small class="text-muted">
                                       Create At: {{ \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
                                    </small>
                                </p>
                                <a href="{{ route('blog.read', Crypt::encrypt($blog->id)) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @include('users.blog.subscribe')
    </div>
@endsection
