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

    public function indexAdmin()
    {
        $products = Product::latest()->get();

        return inertia('Product/IndexAdmin', compact('products'));
    }

   
    public function create()
    {
        return inertia('Product/Create');
    }

    
    public function store(Request $request)
{
    $discount_validations = 'nullable';

    if ($request->has_discount) {
        if ($request->is_percentage === true) {
            $discount_validations = 'required|numeric|min:0|max:100';
        } else {
            $discount_validations = 'required|numeric|min:0|max:' . $request->price;
        }
    }
    
    $validated = $request->validate([
        'name' => 'required|string',
        'category' => 'required|string',
        'brand' => 'required|string',
        'model' => 'nullable|string',
        'colors' => 'nullable|array',
        'part_number' => 'required|string',
        'description' => 'required',
        'price' => 'required|numeric|min:0',
        'is_percentage' => $request->has_discount ? 'required' : 'nullable',
        'stock' => 'required|numeric|min:0',
        'discount' => $discount_validations,
        'features' => 'nullable',
    ]);
    

    // Crea el registro del producto después de la validación
   $product = Product::create($validated);

    return to_route('products.indexAdmin'); // Redirige a la página adecuada después de crear el producto
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
