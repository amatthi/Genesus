<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Log;
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
                $this->charge_and_log($campaign);
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

    public function charge_and_log(Campaign $campaign)
    {
        $description = 'Charge for Camapign#' . $campaign->id;
        $user        = Auth::user();
        $charge      = $user->charge($campaign->sale_price * 100, ['description' => $description]);
        $content     = [
            'id'          => $charge->id,
            'amount'      => $charge->amount,
            'currency'    => $charge->currency,
            'customer'    => $charge->customer,
            'source_id'   => $charge->source->id,
            'status'      => $charge->status,
            'description' => $charge->description,
        ];
        // dd($content, $charge);
        $log          = new Log;
        $log->user_id = $user->id;
        $log->type    = 'charge';
        $log->type_id = $campaign->id;
        $log->content = $content;
        $log->save();
        // dd($charge);
    }
}
