@extends('user.layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Shopping Cart</h2>

    @if($cartItems->count() > 0)

        @foreach($cartItems as $item)
        <div class="card mb-3 p-3 d-flex flex-row align-items-center">

            <!-- IMAGE -->
            <img src="{{ asset('storage/'.$item->image) }}" width="100" class="me-3 rounded">

            <div class="flex-grow-1">
                <h5>{{ $item->name }}</h5>
                <p class="fw-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
            </div>

            <!-- QUANTITY CONTROL -->
            <div class="d-flex align-items-center">

                <!-- MIN BUTTON -->
                <button 
                    class="btn btn-outline-secondary btn-qty updateQty"
                    data-id="{{ $item->id }}"
                    data-change="-1">−</button>

                <span class="mx-3 fw-bold" id="qty-{{ $item->id }}">
                    {{ $item->quantity }}
                </span>

                <!-- PLUS BUTTON -->
                <button 
                    class="btn btn-outline-secondary btn-qty updateQty"
                    data-id="{{ $item->id }}"
                    data-change="1">+</button>
            </div>

            <!-- REMOVE BUTTON -->
            <button class="btn btn-danger ms-4 removeItem"
                    data-id="{{ $item->id }}">
                Delete
            </button>

        </div>
        @endforeach

    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    // =============================
    // UPDATE QUANTITY (+ / -)
    // =============================
    $(".updateQty").click(function(){

        let cartId = $(this).data("id");
        let change = $(this).data("change");

        $.ajax({
            url: "{{ route('cart.update') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                cart_id: cartId,
                change: change
            },
            success: function(res){

                if(res.success){
                    $("#qty-" + cartId).text(res.quantity);
                } else {
                    alert(res.message);
                }
            }
        });
    });

    // =============================
    // REMOVE ITEM
    // =============================
    $(".removeItem").click(function(){

        let cartId = $(this).data("id");

        $.ajax({
            url: "{{ route('cart.remove') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                cart_id: cartId
            },
            success: function(res){
                if(res.success){
                    location.reload();
                }
            }
        });

    });

});
</script>
@endsection
