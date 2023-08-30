<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function index()
    {
        // $user_cart = auth()->user->cart_id;
        $cart_products = CartProduct::with('product')->where('cart_id', 1)->get();

        // return $cart_products;
        return inertia('Cart/Index', compact('cart_products'));
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Cart $cart)
    {
        //
    }

    
    public function edit(Cart $cart)
    {
        //
    }

    
    public function update(Request $request, Cart $cart)
    {
        //
    }

    
    public function destroy(Cart $cart)
    {
        //
    }
}
