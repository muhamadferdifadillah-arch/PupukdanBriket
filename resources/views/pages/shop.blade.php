@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">

    <h1 class="text-2xl font-bold mb-6">Shop Products</h1>

    <div class="grid grid-cols-4 gap-6">
        @forelse ($products as $product)
            <div class="border rounded-lg p-4">
                <img src="{{ asset('uploads/'.$product->image) }}"
                     class="h-40 w-full object-cover mb-3">

                <h2 class="font-semibold">{{ $product->name }}</h2>
                <p class="text-green-600 font-bold">
                    Rp {{ number_format($product->price) }}
                </p>

                <button class="mt-2 w-full bg-green-600 text-white py-2 rounded">
                    Add to Cart
                </button>
            </div>
        @empty
            <p>Tidak ada produk</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
