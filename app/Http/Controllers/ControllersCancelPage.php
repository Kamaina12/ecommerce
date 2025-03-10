<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllersCancelPage extends Controller
{
    public function render()
    {
        return view('Pages.cancel-page');
    }
}
