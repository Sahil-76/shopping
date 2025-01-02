@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">

                <h2>Blog Details</h2>
                <a href="{{ route('blogs.edit', Crypt::encrypt($blog->id)) }}" class="btn btn-info">Edit</a>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h3>{{ Crypt::decrypt($blog->title) }}</h3>

                    {{-- @dd($blog) --}}
                    <p>{!! Crypt::decrypt($blog->description) !!}</p>
                    <small class="text-muted">Published on: {{ $blog->created_at->format('d M Y') }}</small>
                </div>
            </div>

            <h4>Author Information</h4>
            <div class="card mb-3">
                <div class="card-body">
                    <strong>Author Name:</strong> {{ $blog->users->name }}<br>
                    <strong>Email:</strong> {{ $blog->users->email }}
                </div>
            </div>

            <h4>Comments ({{ $blog->comments->count() }})</h4>
            <div class="card mb-3">
                <div class="card-body">
                    @forelse ($blog->comments as $comment)
                        <div class="mb-2">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->content }} <br>
                            <small class="text-muted">Posted on {{ $comment->created_at->format('d M Y H:i') }}</small>
                        </div>
                    @empty
                        <p>No comments yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
