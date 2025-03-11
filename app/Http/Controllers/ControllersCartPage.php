<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Partials\NavbarController;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Cookie;

#[Title('Product Page - Market-cart')]
class ControllersCartPage  extends Component
{
    public $cart_items = [];
    public $grand_total;

    public function mount()
    {
        $this->cart_items = $this->getCartItemsFromCookie();
        $this->grand_total = $this->calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('Pages.cart-page');
    }

    public function removeItem($productId)
    {
        $this->cart_items = $this->removeItemFromCart($productId);
        $this->grand_total = $this->calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-count', total_count: count($this->cart_items))->to(NavbarController::class);
    }

    public function updateQuantity($product_id, $change)
    {
        $cart_items = $this->getCartItemsFromCookie();

        foreach ($cart_items as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] += $change;
                $item['quantity'] = max(1, $item['quantity']);
                $item['total_amount'] = $item['quantity'] * $item['unit_amount'];
            }
        }

        $this->addCartItemsToCookie($cart_items);
        $this->cart_items = $cart_items;
        $this->grand_total = $this->calculateGrandTotal($cart_items);
    }

    private function addItemToCart($product_id)
    {
        $cart_items = $this->getCartItemsFromCookie();
        $existing_item = null;

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                $existing_item = $key;
                break;
            }
        }

        if ($existing_item !== null) {
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['unit_amount'];
        } else {
            $product = Product::where('id', $product_id)->first(['id', 'name', 'price', 'images']);
            if ($product) {
                $cart_items[] = [
                    'product_id' => $product_id,
                    'name' => $product->name,
                    'image' => $product->images[0] ?? 'default.png',
                    'quantity' => 1,
                    'unit_amount' => $product->price,
                    'total_amount' => $product->price,
                ];
            }
        }

        $this->addCartItemsToCookie($cart_items);
        return count($cart_items);
    }

    private function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        return $cart_items ?: [];
    }

    private function removeItemFromCart($product_id)
    {
        $cart_items = $this->getCartItemsFromCookie();

        foreach ($cart_items as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($cart_items[$key]);
            }
        }

        $cart_items = array_values($cart_items);
        $this->addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    private function addCartItemsToCookie($cart_items)
    {
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    private function calculateGrandTotal($items)
    {
        return array_sum(array_column($items, 'total_amount'));
    }
}
