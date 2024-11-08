@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')


<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-md-12 col-lg-7">
                <h4 class="mb-3 text-secondary">100% Premium Pili Nuts</h4>
                <h1 class="mb-5 display-3 text-primary">Locally-sourced products</h1>
                <div class="position-relative mx-auto">
                    <form action="{{ route('product.search') }}" method="GET" class="d-flex">
                        <input name="query" class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" 
                            type="text" placeholder="Search by name, category, or subcategory">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">
                            Submit Now
                        </button>
                    </form>
                </div>

            </div>
            <div class="col-md-12 col-lg-5">
                <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @php
                            // Fetch products to display in the carousel
                            $products = App\Models\Product::with('category')->orderBy('created_at', 'desc')->limit(5)->get();
                        @endphp
                        
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} rounded">
                                    <img src="{{ asset('images/products/' . $product->product_image) }}" class="img-fluid w-100 h-100 bg-secondary rounded" alt="{{ $product->name }}">
                                    <a href="{{ route('product.detail', $product->id) }}" class="btn px-4 py-2 text-white rounded">{{ $product->name }}</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hero End -->


<!-- Products Start -->
<div class="container-fluid py-5 mb-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-12 text-center mb-4">
                <h5 class="text-secondary">Check Our Products</h5>
                <h1 class="display-4">Featured Products</h1>
            </div>
            <div class="col-12">
                @livewire('all-products')
            </div>
        </div>
    </div>
</div>
<!-- Products End -->
@endsection

