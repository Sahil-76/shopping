@extends('guests.layouts.master')
@push('title')
<title>Sitemap</title>
@endpush
@section('content')
<style>
 h1 {
            color: #4a4a4a;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="container">
    <h1>Sitemap</h1>
    <ul>
        @foreach ($sitemapItems as $item)
            <li>
                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection