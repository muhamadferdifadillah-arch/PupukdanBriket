@extends('user.layouts.app')

@section('title', 'All Categories')

@push('styles')
    <style>
        /* Category Card Styles */
        .categories-page-card {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 12px;
            overflow: hidden;
            background: white;
            border: none;
        }

        .categories-page-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .categories-page-card .card-body {
            min-height: 240px;
            padding: 2rem;
        }

        /* Icon Circle Border - sama seperti homepage */
        .categories-icon-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            transition: all 0.3s ease;
            margin: 0 auto 1rem;
        }

        .categories-page-card:hover .categories-icon-circle {
            border-color: #28a745 !important;
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
        }

        .categories-icon-circle img {
            width: 60px !important;
            height: 60px !important;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .categories-page-card:hover .categories-icon-circle img {
            transform: scale(1.1);
        }

        /* Category Title */
        .categories-title {
            font-size: 1.1rem;
            line-height: 1.4;
            transition: color 0.3s ease;
            font-weight: 600;
            color: #212529;
        }

        .categories-page-card:hover .categories-title {
            color: #28a745 !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .categories-page-card .card-body {
                min-height: 200px;
                padding: 1.5rem;
            }

            .categories-title {
                font-size: 1rem;
            }

            .categories-icon-circle {
                width: 100px;
                height: 100px;
            }

            .categories-icon-circle img {
                width: 50px !important;
                height: 50px !important;
            }
        }

        @media (max-width: 576px) {
            .categories-page-card .card-body {
                min-height: 180px;
                padding: 1.25rem;
            }

            .categories-title {
                font-size: 0.95rem;
            }

            .categories-icon-circle {
                width: 90px;
                height: 90px;
            }

            .categories-icon-circle img {
                width: 45px !important;
                height: 45px !important;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">

        <!-- Header Section -->
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">All Categories</h2>
            <p class="text-muted">Browse our product categories</p>
        </div>

        @if($categories->count() > 0)
            <div class="row g-4 justify-content-center">
                @foreach($categories as $cat)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('category.show', $cat->slug) }}" class="text-decoration-none">
                            <div class="categories-page-card card shadow-sm h-100">
                                <div class="card-body text-center d-flex flex-column align-items-center justify-content-center">

                                    <!-- Icon Container with Circle Border -->
                                    <div class="categories-icon-circle">
                                        <img src="{{ asset($cat->icon_image) }}" alt="{{ $cat->name }}">
                                    </div>


                                    <!-- Category Name -->
                                    <h5 class="categories-title mb-0">{{ $cat->name }}</h5>

                                    <!-- Optional: Product Count -->
                                    @if(isset($cat->products_count))
                                        <small class="text-muted mt-2">
                                            {{ $cat->products_count }} {{ $cat->products_count == 1 ? 'product' : 'products' }}
                                        </small>
                                    @endif

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info border-0 shadow-sm text-center py-4">
                <i class="bi bi-info-circle fs-4 mb-2 d-block"></i>
                <p class="mb-0">Belum ada kategori yang tersedia.</p>
            </div>
        @endif

    </div>
@endsection