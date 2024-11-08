<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;

class AllProducts extends Component
{
    use WithPagination;

    public $perPage = 9;
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination on search
    }

    public function chatSeller($sellerId)
    {
        // Redirect to a chat page or initiate a chat session
        return redirect()->route('chat.withSeller', ['seller' => $sellerId]);
    }

    public function render()
    {
        // Fetch products based on search term
        $products = Product::with(['seller', 'category'])
            ->where('name', 'like', '%' . $this->search . '%') // Search by product name
            ->orWhereHas('seller', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%'); // Search by seller name
            })
            ->paginate($this->perPage);

        // Fetch categories that have products associated with them based on the search
        $categories = Category::whereHas('products', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->get();

        return view('livewire.all-products', [
            'products' => $products,
            'categories' => $categories, // Pass categories to the view
        ]);
    }
}
