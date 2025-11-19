<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                            <p class="card-text"><strong>Price:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found.</div>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>