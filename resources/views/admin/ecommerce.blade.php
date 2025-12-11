@extends('layouts.admin')

@section('title', 'Home')

@section('content')

  <div class="container mt-5">
    <h1>Ecommerce Management</h1>

    <div class="row mt-4">
      <div class="col-md-3">
        <div class="card text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Total Products</h5>
            <h2 class="text-primary">{{ count($products) }}</h2>
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary mt-auto">Manage Products</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Categories</h5>
            <h2 class="text-success">{{ count($categories) }}</h2>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-success mt-auto">Manage Categories</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Orders</h5>
            <h2 class="text-warning">0</h2>
            <a href="{{ route('admin.purchase-history.index') }}" class="btn btn-warning mt-auto">View Orders</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card text-center h-100">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Revenue</h5>
            <h2 class="text-info">Rp 0</h2>
            <a href="{{ route('admin.reports.sales') }}" class="btn btn-info mt-auto">View Reports</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">
        <h3>Recent Products</h3>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @forelse($products->take(5) as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td>
                  @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" width="50" height="50"
                      style="object-fit: cover;">
                  @else
                    <img src="https://via.placeholder.com/50" alt="No Image" width="50">
                  @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                  <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                    {{ ucfirst($product->status) }}
                  </span>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center">No products yet. <a href="{{ route('admin.products.create') }}">Add
                    your first product</a></td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@push('css')

@endpush
@push('js')

@endpush