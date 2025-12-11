@extends('layouts.admin')

@section('title', 'Ecommerce Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0">Ecommerce Management</h1>
                <p class="text-muted mb-0">Kelola produk dan kategori toko online Anda</p>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-2">Total Products</h6>
                        <h2 class="mb-3">{{ $totalProducts ?? 0 }}</h2>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">
                            Manage Products
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-2">Categories</h6>
                        <h2 class="mb-3 text-success">{{ $totalCategories }}</h2>
                        <a href="{{ url('/admin/ecommerce/categories') }}" class="btn btn-success btn-sm">
                            Manage Categories
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-2">Orders</h6>
                        <h2 class="mb-3 text-warning">{{ $totalOrders ?? 0 }}</h2>
                        <button class="btn btn-warning btn-sm text-white">
                            View Orders
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted text-uppercase mb-2">Revenue</h6>
                        <h2 class="mb-3 text-info">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h2>
                        <button class="btn btn-info btn-sm text-white">
                            View Reports
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0">Recent Products</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Product list will appear here</p>
            </div>
        </div>
    </div>
@endsection