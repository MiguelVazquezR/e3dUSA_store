<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Discount;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function index()
    {
        // $user_cart = Cart::where('user_id', auth()->id())->get();
        
        $cart_products = CartProduct::with('product')->where('cart_id', 1)->get();
        $discounts = Discount::where('expire_date', '>', now())->get();
        $subtotal = 0;

         foreach ($cart_products as $product) {
           $subtotal += $product->quantity * $product['product']->price;  
        }

        // return $discounts;
        return inertia('Cart/Index', compact('cart_products', 'subtotal', 'discounts'));
    }

    public function paymentVerification()
    {
        $addresses = Address::where('user_id', auth()->id())->get();
        $cart_products = CartProduct::with('product')->where('cart_id', 1)->get();

        // return $cart_products;
        return inertia('Cart/PaymentVerification', compact('addresses', 'cart_products'));
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
        
    }
}
