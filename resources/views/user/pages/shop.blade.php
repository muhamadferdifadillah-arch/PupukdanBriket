@extends('user.layouts.app')

@section('title', 'Shop - Manfaatin')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Semua Produk</h2>
    
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300' }}" 
                     class="card-img-top" alt="{{ $product->name }}">
                
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>

                    <p class="text-success fw-bold">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <!-- 🔥 FIX: Add to Cart button (POST method) -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            Tambah ke Keranjang
                        </button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{ $products->links() }}
</div>
@endsection
