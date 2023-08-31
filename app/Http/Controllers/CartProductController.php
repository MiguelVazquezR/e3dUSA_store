<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {

        $cart = Cart::where('user_id', auth()->id())->first();
        
        CartProduct::create([
            'quantity' => $request->quantity,
            'cart_id' => $cart->id,
            'product_id' => $request->product['id'],
            'created_at' => now(),
        ]);
    }

    
    public function show(CartProduct $cart_product)
    {
        //
    }

    
    public function edit(CartProduct $cart_product)
    {
        //
    }

    
    public function update(Request $request, CartProduct $cart_product)
    {
        //
    }

    
    public function destroy(CartProduct $cart_product)
    {
        $cart_product->delete();
    }
}
