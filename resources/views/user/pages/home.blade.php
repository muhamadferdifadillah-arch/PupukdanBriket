@extends('user.layouts.app')

@section('title', 'Home - Organic Fertilizer')
@section('keywords', 'organic fertilizer, compost, charcoal briquettes, environmentally friendly')
@section('description', 'Manfaatin - Your trusted source for organic fertilizer and eco-friendly products')

@section('content')

    <!-- Hero Section -->
    @include('user.sections.hero')

    <!-- Categories Section -->
    @include('user.sections.categories')

    <!-- Best Selling Products -->
    @include('user.sections.best-selling')

    <!-- Banner Ads -->
    @include('user.sections.banner-ads')

    <!-- Featured Products -->
    @include('user.sections.featured')

    <!-- Newsletter -->
    @include('user.sections.newsletter')

    <!-- Popular Products -->
    @include('user.sections.popular')

    <!-- Latest Products -->
    @include('user.sections.latest')

    <!-- Blog Section -->
    @include('user.sections.blog')

    <!-- App Download -->
    @include('user.sections.app-download')

    <!-- Keywords -->
    @include('user.sections.keywords')

    <!-- Info Cards -->
    @include('user.sections.info-cards')

@endsection

@push('scripts')
<script>
    // Custom JS for homepage
    $(document).ready(function() {
        console.log('Homepage loaded');
    });
</script>
@endpush