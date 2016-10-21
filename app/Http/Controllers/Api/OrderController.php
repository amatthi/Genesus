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

    public function pay(Request $request)
    {
        $user   = Auth::user();
        $result = false;
        $post   = $request->all();
        if (isset($post['token'])) {
            $this->check_token($post['token']);
        } else if (!$user->hasStripeId()) {
            return response(['stripe' => ['Payment method not found']], 422);
        }

        switch ($post['type']) {
            case 'buy_campaign':
                $campaign = Campaign::where('id', $post['data']['id'])->firstOrFail();
                $user->charge($campaign->sale_price * 100);
                $result = $this->buy_campaign($campaign);
                break;

            default:
                return response(['slug' => ['Pay type not found']], 422);
                break;
        }
        return $result;
        //dd($request->all());
    }

    public function buy_campaign(Campaign $campaign)
    {
        $order              = new Order;
        $order->campaign_id = $campaign->id;
        $order->user_id     = Auth::user()->id;
        $order->status      = 'paid';
        $order->save();
        return $order;
    }

    public function check_token($token)
    {
        $user     = Auth::user();
        $customer = $user->createAsStripeCustomer($token);
    }
}
