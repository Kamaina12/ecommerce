<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Category Page -Market-cart')]
class ControllersCategoriesPage extends Controller
{
    public function __invoke()
    {
        $category = Category::where('is_active',1)->get();
        return view('Pages.categories-page',[
            'category' => $category
        ]);
    }
}
