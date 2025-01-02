@extends('guests.layouts.master')

@push('title')
    <title>{{ Crypt::decrypt($blog->title) }}</title>
@endpush

@section('content')
    <div class="container">
        <div class="responsive">
            <h2>{{ Crypt::decrypt($blog->title) }}</h2>
            <img src="{{ Crypt::decrypt($blog->image) }}" alt="Blog Image" class="img-fluid" height="300px">

            <div class="mt-4" style="text-align: justify;">
                <h5>Blog Description</h5>
                <p>{!! Crypt::decrypt($blog->description) !!}</p>
            </div>

            <p>
                <small class="text-muted">
                    Published By: {{ $blog->users->name }}
                </small>
                <br>
                <small class="text-muted">
                    Published on:
                    {{ \Carbon\Carbon::parse($blog->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
                </small>
            </p>

            <!-- Comments Section -->
            <div class="row responsive">
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="comment">
                        <h5>Comments</h5>
                        @if ($blog->comments->isEmpty())
                            <p>No comments yet. Be the first to comment!</p>
                        @else
                            <div class="mes"
                                style="height: 18rem; overflow-x: auto; scrollbar-width: thin; scrollbar-color: #888 #f1f1f1;">
                                @foreach ($blog->comments as $comment)
                                    <div class="border p-2 mb-2">
                                        <div class="row">
                                            <strong>
                                                <i class="fa fa-user-circle mr-2" aria-hidden="true"></i>
                                                {{-- {{ $comment->user->name ? $comment->user->name : 'No Name' }} --}}
                                                {{  $comment->name ? Crypt::decrypt($comment->name) : "No Name" }}
                                            </strong>
                                        </div>
                                        <hr>
                                        <p>{{ Crypt::decrypt($comment->comment) }}</p>
                                        <small class="text-muted">
                                            Commented on:
                                            {{ \Carbon\Carbon::parse($comment->created_at)->setTimezone('Asia/Kolkata')->format('d-M-Y h:i A') }}
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">

                        <form action="{{ route('blog.comment', Crypt::encrypt($blog->id)) }}" method="post">
                            @csrf
                            <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog->id }}">

                            <div class="form-group">
                                <label for="Name">Name:</label>
                                <input type="text" class="form-control" id="Name" name="name" rows="8" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" rows="8" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex" style="justify-content: space-between;">
                                <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                <a href="{{ route('blog') }}" class="btn btn-primary">Back to Blog List</a>
                            </div>
                        </form>
                </div>
            </div>

        </div>
        @include('users.blog.subscribe')
    @endsection
