<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        return inertia('PaymentMethod/Create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string|min:16',
            'owner_name' => 'required|string',
        ]);

        PaymentMethod::create($request->all() + ['user_id' => auth()->id()]);

        // return to_route('profile.show');
    }

    
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    
    public function destroy(PaymentMethod $paymentMethod)
    {
        //
    }
}
