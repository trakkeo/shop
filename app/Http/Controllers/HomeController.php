<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index () {
        $products = Product::with('pictures')->orderBy('created_at', 'desc')->limit(3)->get();
        $starredProducts = Product::with('pictures')->where('starred', true)->orderBy('created_at', 'desc')->limit(3)->get();
        return view('home', ['products' => $products, 'starredProducts' => $starredProducts]);
    }

}
