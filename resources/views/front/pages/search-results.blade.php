@extends('front.layout.pages-layout')
@section('pageTitle', 'Search Results for ' . $query)

@section('content')
<div class="container py-5">
    <h2>Search Results for "{{ $query }}"</h2>

    @if ($products->isEmpty())
        <p>No products found matching your search criteria.</p>
    @else
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                    @foreach ($products as $item)
                        <div class="col-md-3 mb-4"> <!-- Four items per row -->
                            <div class="rounded position-relative fruite-item">
                                <div class="product-img">
                                    <img src="{{ asset('images/products/' . $item->product_image) }}" class="img-fluid w-100 rounded-top" alt="{{ $item->name }}">
                                </div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4><a href="{{ route('product.detail', $item->id) }}">{{ $item->name }}</a></h4>
                                    <div class="description" id="summary">
                                        {!! Str::limit($item->summary, 100) !!}
                                    </div>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <div class="price">
                                            @if ($item->compare_price)
                                                <del>₱{{ $item->compare_price }}</del>
                                            @endif
                                            <ins>₱{{ $item->price }}</ins>
                                        </div>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary" wire:click="chatSeller({{ $item->seller->id }})">
                                            <i class="fas fa-comment-dots me-2 text-primary"></i>Chat Seller
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-4">
                    {{ $products->links() }} <!-- Pagination links for paginated results -->
                </div>
            </div>
        </div>
    @endif
</div>
@endsection