<?php

namespace App\Http\Controllers;

use App\Models\NotificationEmail;
use Illuminate\Http\Request;

class NotificationEmailController extends Controller
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
            'email' => 'required|email|unique:notification_emails,email',
        ]);

        NotificationEmail::create($request->all());
    }

    
    public function show(NotificationEmail $notificationEmail)
    {
        //
    }

    
    public function edit(NotificationEmail $notificationEmail)
    {
        //
    }

    
    public function update(Request $request, NotificationEmail $notificationEmail)
    {
        //
    }

    
    public function destroy(NotificationEmail $notificationEmail)
    {
        //
    }
}
