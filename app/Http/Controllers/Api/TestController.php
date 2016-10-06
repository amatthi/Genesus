<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;

class TestController extends Controller
{
    public function __construct()
    {

    }

    protected function test()
    {
        echo 'hi test';
        var_dump(Auth::user());
    }
}
