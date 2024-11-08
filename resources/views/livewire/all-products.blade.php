<div class="tab-content">
    <div id="tab-1" class="tab-pane fade show p-0 active">
        <div class="row g-4">
            @forelse ($products as $item)
                <div class="col-md-3 mb-4"> <!-- Changed to col-md-3 to fit 4 items per row -->
                    <div class="rounded position-relative fruite-item">
                        <!-- Display category name at the top without using id -->
                        <div class="text-white bg-secondary px-3 py-1 rounded-top position-absolute" style="top: 10px; left: 10px;">
                            {{ $item->category->category_name ?? 'Uncategorized' }} <!-- Display the category name -->
                        </div>
                        <div class="product-img">
                            <img src="/images/products/{{ $item->product_image }}" class="img-fluid w-100 rounded-top" alt="{{ $item->name }}">
                        </div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4><a href="#">{{ $item->name }}</a></h4>
                            <div class="description" id="summary">
                                {!! $item->summary !!}
                            </div>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <div class="price">
                                    @if ($item->compare_price)
                                        <del>₱{{ $item->compare_price }}</del>
                                    @endif
                                    <ins>₱{{ $item->price }}</ins>
                                </div>
                                <a href="{{ route('chat.withSeller', $item->seller->id) }}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                <i class="fas fa-comment-dots me-2 text-primary"></i>Chat Seller
                            </a>

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products available.</p>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $products->links() }} <!-- Livewire pagination links -->
        </div>
    </div>
</div>
