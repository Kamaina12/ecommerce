<?php

namespace App\Http\Controllers\Partials;
use App\Helpers\CartManagement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Livewire\Attributes\On;
class NavbarController extends Controller
{
   
    public $total_count =0;

    public function mount()
    {
        $this->total_count = count(CartManagement::getcartItemsFromCookie());
    }

    #[On('update-cart-count')]

    public function updateCartCount($total_count)
    {
        $this->total_count = count(CartManagement::getcartItemsFromCookie());
    }

 
}
