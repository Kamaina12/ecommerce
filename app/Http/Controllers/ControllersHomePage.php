<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;

class ControllersHomePage extends Controller
{
    public function __invoke()
    {
        $brands = Brand::where('is_active', 1)->get();
        $category = Category::where('is_active', 1)->get();
        
        return view('Pages.home-page', [
            'brands' => $brands,
            'category' => $category
        ]);
    }
}
