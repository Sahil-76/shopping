@extends('guests.layouts.master')

@push('title')
    <title>Products by Category</title>
@endpush

@section('content')
    <div class="container">
        @if ($products->isNotEmpty())
            <h1 class="my-4">Products in Category: {{ ucfirst(Crypt::decrypt($products->first()->category->name)) }}</h1>
            <!-- Display the category name -->
        @else
            <h1 class="my-4">No Products Found .</h1>
        @endif

        @if ($products->isEmpty())
            <p>No products found .</p>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ crypt::decrypt($product->image) }}" class="card-img-top" alt="{{ $product->name }}"
                                style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                <!-- Limit description to 100 characters -->
                                @if (auth()->check())
                                    <a href="{{ url(Crypt::decrypt($product->link)) }}" class="btn btn-secondary"
                                        onclick="return confirmRedirect('You are about to be redirected to the Amazon website. Do you want to continue?')">
                                        Buy Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Login to buy</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <script>
        function confirmRedirect() {
            if (confirm('You are about to be redirected to the Amazon website. Do you want tocontinue ? ')) {
                    return true;
                }
                else {
                    return false;

                }
            }
    </script>
@endsection
