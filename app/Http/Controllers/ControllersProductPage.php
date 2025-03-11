<?php

namespace App\Http\Controllers;

use App\Helpers\CartManagement;
use App\Http\Controllers\Partials\NavbarController;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Product Page - Market-cart')]
class ControllersProductPage extends Component
{
    use WithPagination;

    #[Url] public $selected_categories = [];
    #[Url] public $selected_brands = [];
    #[Url] public $featured = [];
    #[Url] public $onsale = [];
    #[Url] public $price_range = 300000;
    #[Url] public $sort = 'latest';

    // Add to cart function
    public function addToCart($productId)
    {
        $total_count = CartManagement::addItemToCart($productId);
        $this->dispatch('update-cart-count', ['total_count' => $total_count])->to(NavbarController::class);
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }

        if (!empty($this->featured)) {
            $productQuery->where('is_featured', 1);
        }

        if (!empty($this->onsale)) {
            $productQuery->where('on_sale', 1);
        }

        if (!empty($this->price_range)) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        // Sorting logic
        if ($this->sort === 'latest') {
            $productQuery->latest();
        } elseif ($this->sort === 'price') {
            $productQuery->orderBy('price');
        }

        $categories = Category::where('is_active', 1)->get();
        $brands = Brand::where('is_active', 1)->get();

        return view('Pages.product-page', [
            'products' => $productQuery->paginate(6),
            'categories' => $categories,
            'brands' => $brands,
            'price_range' => $this->price_range, // Pass price_range to view
        ]);
    }
}
