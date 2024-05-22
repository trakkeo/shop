<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.products.index', [
           'products' => Product::orderBy('created_at', 'desc')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $product->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 1,
            'floor' => 0,
            'city' => 'Montpellier',
            'postal_code' => 34000,
            'sold' => false,
        ]);
        return view('admin.products.form', [
            'product' => $product,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request)
    {
        $product = Product::create($request->validated());
        $product->options()->sync($request->validated('options'));
        $product->attachFiles($request->validated('pictures'));
        return to_route('admin.product.index')->with('success', 'Le produit a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product' => $product,
            'options' => Option::pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, Product $product)
    {
        $product->update($request->validated());
        $product->options()->sync($request->validated('options'));
    
        if ($request->hasFile('pictures')) {
            $product->attachFiles($request->file('pictures'));
        }
    
        return to_route('admin.product.index')->with('success', 'Le produit a bien été modifié');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Picture::destroy($product->pictures()->pluck('id'));
        $product->delete();
        return to_route('admin.product.index')->with('success', 'Le bien a produit été supprimé');
    }
}
