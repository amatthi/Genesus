<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home')->with('stripe_key', env('STRIPE_KEY'));
    }

    public function launch()
    {
        return view('launch');
    }
}
