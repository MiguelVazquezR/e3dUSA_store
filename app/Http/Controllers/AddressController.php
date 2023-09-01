<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        return inertia('Address/Create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'postal_code' => 'required|string|min:5|max:6',
            'receiver_name' => 'required|string',
            'phone' => 'required|string|min:10',
        ]);

        Address::create($request->all() + ['user_id' => auth()->id()]);

        return to_route('carts.payment-verification');
    }

    
    public function show(Address $address)
    {
        //
    }

    
    public function edit(Address $address)
    {
        return inertia('Address/Edit', compact('address'));
    }

    
    public function update(Request $request, Address $address)
    {
        //
    }

    
    public function destroy(Address $address)
    {
        $address->delete();
    }
}
