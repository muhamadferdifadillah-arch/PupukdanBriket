@extends('user.layouts.app')

@section('content')
<div class="container py-5">

    <h3 class="mb-4">
        Hasil pencarian untuk: <strong>{{ $query }}</strong>
    </h3>

    @if($products->count() == 0)
        <p class="text-muted">Tidak ada produk ditemukan.</p>
    @endif

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">

                    @if($product->image && file_exists(public_path($product->image)))
                        <img src="{{ asset($product->image) }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;"
                             alt="{{ $product->name }}">
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" 
                             style="height: 200px;">
                            <span class="text-white">No Image Available</span>
                        </div>
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>

                        <p class="fw-bold text-primary">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                Add to Cart
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection