<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;

class CampaignController extends Controller
{
    public function __construct()
    {

    }

    protected function launch()
    {
        echo 'hi test';
        var_dump(Auth::user());
    }
}
