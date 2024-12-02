<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request) {
        $message = $request->validate([
                'title' => 'required',
                'body' => 'required'    
        ]);
        return redirect('/');
    }
}
