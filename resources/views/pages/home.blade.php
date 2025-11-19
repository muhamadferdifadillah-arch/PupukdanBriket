@extends('layouts.app')

@section('title', 'Home - ManfaatinOnline.com')

@section('content')

<!-- Hero Section -->
<section style="background-image: url('{{ asset('user/images/ferdi.png') }}');background-repeat: no-repeat;background-size: cover;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 pt-5 mt-5">
                <h2 class="display-1 ls-1">
                    <span class="fw-bold" style="color: #00a651;">Organic</span> Fertilizer 
                    <span class="fw-bold" style="color: #00a651;">Environmentally</span> Friendly
                </h2>
                <div class="d-flex gap-3">
                    <a href="{{ route('shop') }}" class="btn btn-primary text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">Start Shopping</a>
                    <a href="{{ route('register') }}" class="btn btn-dark text-uppercase fs-6 rounded-pill px-4 py-3 mt-3">Join Now</a>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-0 justify-content-center">
            <div class="col">
                <div class="card border-0 bg-primary rounded-0 p-4 text-light">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <svg width="60" height="60"><use xlink:href="#fresh"></use></svg>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body p-0">
                                <h5 class="text-light">Fresh from farm</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 bg-secondary rounded-0 p-4 text-light">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <svg width="60" height="60"><use xlink:href="#organic"></use></svg>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body p-0">
                                <h5 class="text-light">100% Organic</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 bg-danger rounded-0 p-4 text-light">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <svg width="60" height="60"><use xlink:href="#delivery"></use></svg>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body p-0">
                                <h5 class="text-light">Free delivery</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Category Section -->
<section class="py-5 overflow-hidden">
    <div class="container-lg">
        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
            <h2 class="section-title">Category</h2>
            <a href="{{ route('shop') }}" class="btn btn-primary">View All</a>
        </div>
        
        <div class="row">
            <div class="col-md-3 col-6 text-center">
                <a href="{{ route('shop.category', 'fertilizer') }}" class="nav-link">
                    <img src="{{ asset('user/images/category-thumb-1.jpg') }}" class="rounded-circle" alt="Fertilizer" style="width:120px; height:120px; object-fit:cover;">
                    <h4 class="fs-6 mt-3 fw-normal">Fertilizer</h4>
                </a>
            </div>
            <div class="col-md-3 col-6 text-center">
                <a href="{{ route('shop.category', 'charcoal') }}" class="nav-link">
                    <img src="{{ asset('user/images/category-thumb-2.jpg') }}" class="rounded-circle" alt="Charcoal" style="width:120px; height:120px; object-fit:cover;">
                    <h4 class="fs-6 mt-3 fw-normal">Charcoal</h4>
                </a>
            </div>
            <div class="col-md-3 col-6 text-center">
                <a href="{{ route('shop.category', 'briquettes') }}" class="nav-link">
                    <img src="{{ asset('user/images/category-thumb-3.jpg') }}" class="rounded-circle" alt="Briquettes" style="width:120px; height:120px; object-fit:cover;">
                    <h4 class="fs-6 mt-3 fw-normal">Charcoal Briquettes</h4>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection