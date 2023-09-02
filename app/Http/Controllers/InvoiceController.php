<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
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
        $request->validate([
            'name' => 'required|string',
            'patern_last_name' => 'required|string',
            'mother_last_name' => 'required|string',
            'rfc' => 'required|string',
            'tax_regime' => 'required|string',
            'cfdi_use' => 'required|string',
            'postal_code' => 'required|string',
            'street' => 'required|string',
            'outdoor_number' => 'required|string',
            'interior_number' => 'nullable|string',
            'colony' => 'required|string',
            'city_halll' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|min:10',
        ]);

        Invoice::create($request->all() + ['user_id' => auth()->id()]);

    }

    public function show(Invoice $invoice)
    {
        //
    }

    
    public function edit(Invoice $invoice)
    {
        //
    }

    
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
    }
}
