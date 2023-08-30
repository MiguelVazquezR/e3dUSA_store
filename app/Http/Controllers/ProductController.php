<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();

        return inertia('Product/Index', compact('products'));
    }

   
    public function create()
    {
        return inertia('Product/Create');
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show(Product $product)
    {

        $similar_products = Product::where('category', $product->category)->get(); 
        
        // return $similar_products;
        return inertia('Product/Show', compact('product', 'similar_products'));
    }

    
    public function edit(Product $product)
    {
        //
    }

   
    public function update(Request $request, Product $product)
    {
        //
    }

    
    public function destroy(Product $product)
    {
        //
    }
}
