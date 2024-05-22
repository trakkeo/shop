<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductContactRequest;
use App\Http\Requests\SearchProductsRequest;
use App\Mail\ProductContactMail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{

    public function index(SearchProductsRequest $request)
    {
        $query = Product::query()->with('pictures')->orderBy('created_at', 'desc');
        if ($price = $request->validated('price')) {
            $query = $query->where('price', '<=', $price);
        }
        if ($memory = $request->validated('memory')) {
            $query = $query->where('memory', '>=', $memory);
        }
        if ($screen_size = $request->validated('screen_size')) {
            $query = $query->where('screen_size', '>=', $screen_size);
        }
        if ($name = $request->validated('name')) {
            $query = $query->where('name', 'like', "%{$name}%");
        }
        return view('product.index', [
           'products' => $query->paginate(16),
            'input' => $request->validated()
        ]);
    }

    public function show(string $slug, Product $product)
    {
        $expectedSlug =$product->getSlug();
        if ($slug !== $expectedSlug) {
            return to_route('product.show', ['slug' => $expectedSlug, 'product' => $product]);
        }

        return view('product.show', [
            'product' => $product
        ]);
    }

    public function contact(Product $product, ProductContactRequest $request)
    {
        Mail::send(new ProductContactMail($product, $request->validated()));
        return back()->with('success', 'Votre demande de contact a bien été envoyé');
    }

}
