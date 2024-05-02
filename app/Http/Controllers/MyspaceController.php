<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyspaceController extends Controller
{
    //
     public function __invoke(){
        
        return view('customers/customer_welcome', [
            'user' => auth()->user()
        ]);
    }
}
