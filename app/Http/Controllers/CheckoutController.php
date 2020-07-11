<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!auth()->check())
        {
            return redirect()->route('login');
        }

        if(!session()->has('cart'))
        {
            return redirect()->route('home');
        }

        return view('checkout');
    }
}
