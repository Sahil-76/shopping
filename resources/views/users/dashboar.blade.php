@extends('guests.layouts.master')
@push('title')
<title>User Dashboard</title>
@endpush
@section('content')
<H1 class="text-center">Welcome {{ ucfirst(auth()->user()->name) }}!</H1>
<div class="container mt-3">
    <div class="row" style="position: sticky; top: 83px; z-index: 1;">
        <div class="input-group mb-4 col-6 ml-auto">
            <input type="text" id="productSearch" class="form-control" placeholder="Search products by name or category">
        </div>
    </div>
    <div class="row" id="productGrid">
        @foreach ($products as $product)
        <div class="col-md-4 product-item" 
             data-name="{{ strtolower($product->name) }}" 
             data-category="{{ strtolower(Crypt::decrypt($product->category->name)) }}"
             data-description="{{ strtolower($product->description) }}"
             style="display: {{ $loop->index < 10 ? 'block' : 'none' }};"> <!-- Use $loop->index -->
            <div class="card mb-4">
                <img src="{{ Crypt::decrypt($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="width: 100%; aspect-ratio: 16/9; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><b>Product Name: <u>{{ Str::words(ucfirst($product->name),10) }}</u></b></h5>
                    <p class="card-text"><strong>Category:</strong> {{ Crypt::decrypt($product->category->name) }}</p>
                    <p class="card-text text-justify">
                        <strong>Description: </strong>
                        {{ implode(' ', array_slice(explode(' ', $product->description), 0, 20)) }}{{ count(explode(' ', $product->description)) > 15 ? '...' : '' }}
                    </p>

                    @if (auth()->check())
                    <form action="{{ (Crypt::decrypt($product->link)) }}" method="get">
                        <button type="submit" class="btn btn-primary" onclick="return confirmRedirect('You are about to be redirected to the Amazon website. Do you want to continue?')">
                            Buy Now</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login to buy</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
     @if (count($products) > 10)
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <button id="loadMore" class="btn btn-outline-primary">Load More</button>
                </div>
            </div>
        @endif
</div>
<script>
    document.getElementById('productSearch').addEventListener('keyup', function() {
        let searchTerm = this.value.toLowerCase();
        let products = document.querySelectorAll('.product-item');

        products.forEach(function(product) {
            let name = product.getAttribute('data-name');
            let category = product.getAttribute('data-category');
            let description = product.getAttribute('data-description');

            if (name.includes(searchTerm) || category.includes(searchTerm) || description.includes(searchTerm)) {
                product.style.display = 'block'; // Show product
            } else {
                product.style.display = 'none'; // Hide product
            }
        });
    });

    let productsToShow = 10;
        let totalProducts = {{ count($products) }};
        let loadMoreButton = document.getElementById('loadMore');

        loadMoreButton.addEventListener('click', function() {
            let hiddenProducts = document.querySelectorAll('.product-item[style="display: none;"]');

            for (let i = 0; i < 10 && i < hiddenProducts.length; i++) {
                hiddenProducts[i].style.display = 'block';
            }

            productsToShow += 10;

            // Hide load more button if all products are shown
            if (productsToShow >= totalProducts) {
                loadMoreButton.style.display = 'none';
            }
        });

    function confirmRedirect(message) {
        return confirm(message); // Simplified
    }
</script>
@endsection
