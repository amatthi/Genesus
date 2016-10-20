<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Order;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {

    }

    public function buy(Campaign $campaign, Request $request)
    {
        $order              = new Order;
        $order->campaign_id = $campaign->id;
        $order->user_id     = Auth::user()->id;
        $order->status      = 'create';
        $order->save();
        return $order;
    }
}
