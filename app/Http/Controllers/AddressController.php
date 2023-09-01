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
        //
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
