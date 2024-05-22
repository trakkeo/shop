<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index () {
        $products = Product::with('pictures')->orderBy('created_at', 'desc')->limit(4)->get();
        return view('home', ['products' => $products]);
    }

}
