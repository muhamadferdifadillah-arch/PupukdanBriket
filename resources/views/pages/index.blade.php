@extends('layouts.app')

@section('title', 'Home')

@section('content')
<section style="background-image: url('{{ asset('user/images/ferdi.png') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-6 pt-5 mt-5">
                <h2 class="display-1 ls-1">
                    <span class="fw-bold" style="color: #00a651;">Organic</span> Fertilizer 
                    <span class="fw-bold" style="color: #00a651;">Environmentally</span> Friendly
                </h2>
            </div>
        </div>
        
        <!-- Feature cards -->
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-3 g-0 justify-content-center">
            <div class="col">
                <div class="card border-0 bg-primary rounded-0 p-4 text-light">
                    <!-- card content -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sections lainnya -->
@endsection