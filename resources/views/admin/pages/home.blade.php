@extends('layouts.app')

@section('content')

<section class="hero-section">
    <div class="hero-content">
        <h1>Fresh Organic Food</h1>
        <p>Delivered directly from our farm to your home.</p>
        <a href="#" class="btn btn-primary">Shop Now</a>
    </div>
    <img src="images/hero-img.png" class="hero-img" alt="Organic">
</section>

<section class="category-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title">Category</h2>

            <div class="d-flex">
                <button class="cat-prev btn btn-outline-primary btn-sm me-2">‹</button>
                <button class="cat-next btn btn-outline-primary btn-sm">›</button>
            </div>
        </div>

        <div class="category-carousel swiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide text-center">
                    <img src="{{ asset('user/images/category-thumb-1.jpg') }}" class="rounded-circle" alt="">
                    <h4 class="fs-6 mt-3">Compost</h4>
                </div>

                <div class="swiper-slide text-center">
                    <img src="{{ asset('user/images/logom.jpg') }}" class="rounded-circle" alt="">
                    <h4 class="fs-6 mt-3">Charcoal Briquettes</h4>
                </div>

                <div class="swiper-slide text-center">
                    <img src="{{ asset('user/images/category-thumb-3.jpg') }}" class="rounded-circle" alt="">
                    <h4 class="fs-6 mt-3">Fruits & Veges</h4>
                </div>

                <div class="swiper-slide text-center">
                    <img src="{{ asset('user/images/category-thumb-4.jpg') }}" class="rounded-circle" alt="">
                    <h4 class="fs-6 mt-3">Beverages</h4>
                </div>

                <div class="swiper-slide text-center">
                    <img src="{{ asset('user/images/category-thumb-5.jpg') }}" class="rounded-circle" alt="">
                    <h4 class="fs-6 mt-3">Meat Products</h4>
                </div>

            </div>
        </div>

    </div>
</section>



<section class="product-section">
    <h2 class="section-title">Featured Products</h2>
    <div class="product-list d-flex gap-4 justify-content-center">

        <div class="product-card">
            <img src="images/product-1.png" alt="">
            <h3>Fresh Apples</h3>
            <p>$4.99 / kg</p>
            <a href="#" class="btn btn-outline-primary">Add to Cart</a>
        </div>

        <div class="product-card">
            <img src="images/product-2.png" alt="">
            <h3>Organic Carrots</h3>
            <p>$2.49 / kg</p>
            <a href="#" class="btn btn-outline-primary">Add to Cart</a>
        </div>

        <div class="product-card">
            <img src="images/product-3.png" alt="">
            <h3>Fresh Oranges</h3>
            <p>$3.49 / kg</p>
            <a href="#" class="btn btn-outline-primary">Add to Cart</a>
        </div>

    </div>
</section>


<section class="promo-section">
    <div class="promo-box">
        <h2>Get 20% Off on Your First Order!</h2>
        <p>Use code: ORGANIC20</p>
        <a href="#" class="btn btn-primary">Shop Now</a>
    </div>
</section>


<section class="testimonial-section">
    <h2 class="section-title">What Our Customers Say</h2>
    <div class="testimonials d-flex gap-4 justify-content-center">

        <div class="testimonial-card">
            <p>“Very fresh fruits and fast delivery, recommended!”</p>
            <h4>– Sarah</h4>
        </div>

        <div class="testimonial-card">
            <p>“Quality vegetables at affordable prices. Love it!”</p>
            <h4>– Michael</h4>
        </div>

    </div>
</section>

@endsection
