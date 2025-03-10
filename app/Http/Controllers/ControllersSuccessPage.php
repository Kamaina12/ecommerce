<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllersSuccessPage extends Controller
{
    public function render()
    {
        return view('Pages.success-page');
    }
}
