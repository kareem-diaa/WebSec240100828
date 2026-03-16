@extends('layouts.master')
@section('title', 'Products Catalog')
@section('content')

<div class="m-4">
    <h3 class="mb-4">🛍️ Products Catalog</h3>
    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-muted flex-grow-1">{{ $product->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="fs-5 fw-bold text-success">
                            {{ number_format($product->price) }} EGP
                        </span>
                        <button class="btn btn-primary btn-sm"
                            onclick="addToCart('{{ $product->name }}')">
                            🛒 Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function addToCart(name) {
        alert(name + ' has been added to your cart!');
    }
</script>

@endsection