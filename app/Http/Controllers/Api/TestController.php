<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use App\Profile;

class TestController extends Controller
{
    public function __construct()
    {

    }

    protected function test()
    {
        echo 'hi test';
        $a = Auth::user()->charge(100);
        dd($a);
    }
}
