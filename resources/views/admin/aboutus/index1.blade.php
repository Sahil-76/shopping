@extends('guests.layouts.master')

@push('title')
    <title>About Us - My Amazone</title>
@endpush

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">About Us</h1>
    <p>Welcome to My Amazone, your go-to destination for finding the best products available on Amazon! As an Amazon affiliate, we are dedicated to curating a wide selection of quality products that cater to your needs and interests.</p>

    <h2>Our Mission</h2>
    <p>At My Amazone, our mission is to simplify your shopping experience. We believe that shopping should be effortless and enjoyable, which is why we provide detailed product information, reviews, and comparisons. We strive to help you make informed purchasing decisions by highlighting the best products available.</p>

    <h2>What We Offer</h2>
    <ul>
        <li>Curated product listings across various categories.</li>
        <li>Honest and unbiased product reviews.</li>
        <li>Exclusive deals and promotions from Amazon.</li>
        <li>Informative articles and guides to help you choose the right products.</li>
    </ul>

    <h2>Why Choose Us?</h2>
    <p>We take pride in our ability to research and analyze products so you don’t have to. Our team is committed to ensuring that you find the best products that suit your preferences. As an Amazon affiliate, we earn a small commission on products purchased through our links, allowing us to keep our site running and continue providing valuable content.</p>

    <h2>Join Our Community</h2>
    <p>We invite you to explore our website and discover amazing products that can enhance your life. Don’t forget to subscribe to our newsletter for updates on the latest products and exclusive offers!</p>

    <h2>Contact Us</h2>
    <p>If you have any questions, suggestions, or feedback, please feel free to reach out to us through our <a href="{{ route('contact') }}">contact page</a>. We would love to hear from you!</p>

    <p>Thank you for visiting My Amazone. Happy shopping!</p>
</div>
@endsection
