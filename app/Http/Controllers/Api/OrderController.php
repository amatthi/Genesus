<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Log;
use App\Order;
use App\User;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $user;
    public function __construct()
    {

    }

    public function pay(Request $request)
    {
        $this->user = (Auth::user()) ? Auth::user() : new User;
        $result     = false;
        $post       = $request->all();
        if (isset($post['token'])) {
            if ($this->user->exists) {
                $this->check_token($post['token']);
            }
        } else if (!$this->user->hasStripeId()) {
            return response(['stripe' => ['Payment method not found']], 422);
        }

        switch ($post['type']) {
            case 'buy_campaign':
            \Slack::send('A new order has been placed!');
                $this->validate($request, [
                    'full_name'       => 'required|max:255',
                    'street_address'  => 'required|max:255',
                    'state'           => 'required|max:255',
                    //'country'         => 'required|max:255',
                    'city'            => 'required|max:255',
                    'zipcode'         => 'required|max:255',
                ]);
                $campaign = Campaign::where('id', $post['data']['id'])->firstOrFail();
                $this->charge_and_log($campaign, $post);
                $result = $this->buy_campaign($campaign, $request);
                break;

            default:
                return response(['slug' => ['Pay type not found']], 422);
                break;
        }
        return $result;
        //dd($request->all());
    }

    public function buy_campaign(Campaign $campaign, Request $request = null)
    {
        $order              = new Order;
        $order->campaign_id = $campaign->id;
        $order->user_id     = ($this->user->id) ? $this->user->id : 0;
        $order->status      = 'paid';
        $order->others      = $request->only(['email', 'full_name', 'city', 'street_address', 'state', 'street_address2', 'zipcode', 'voucher']);
        $order->save();
        return $order;
    }

    public function check_token($token)
    {
        $user     = Auth::user();
        $customer = $user->createAsStripeCustomer($token);
    }

    public function charge_and_log(Campaign $campaign, array $post)
    {
        $description = 'Charge for Camapign#' . $campaign->id;
        $voucher_code = $this->user->voucher;
        $email = $this->user->email;
        $option      = ['description' => $description];
        if (!$this->user->exists) {
            $option['source'] = $post['token'];
            if ($voucher_code = 'CORE2017' || $voucher_code = 'DESTINY2017') {
        $charge  = $this->user->charge(round($campaign->sale_price * 70), $option);
        $content = [
            'id'            => $charge->id,
            'amount'        => $charge->amount,
            'currency'      => $charge->currency,
            'customer'      => $charge->customer,
            'source_id'     => $charge->source->id,
            'status'        => $charge->status,
            'description'   => $charge->description,
            "receipt_email" => $charge->email,
        ];
        // dd($content, $charge);
        $log          = new Log;
        $log->user_id = ($this->user->id) ? $this->user->id : 0;
        $log->type    = 'charge';
        $log->type_id = $campaign->id;
        $log->content = $content;
        $log->save();
        // dd($charge);
        } else {
        $charge  = $this->user->charge($campaign->sale_price * 100, $option);
        $content = [
            'id'            => $charge->id,
            'amount'        => $charge->amount,
            'currency'      => $charge->currency,
            'customer'      => $charge->customer,
            'source_id'     => $charge->source->id,
            'status'        => $charge->status,
            'description'   => $charge->description,
            "receipt_email" => $charge->email,
        ];
        // dd($content, $charge);
        $log          = new Log;
        $log->user_id = ($this->user->id) ? $this->user->id : 0;
        $log->type    = 'charge';
        $log->type_id = $campaign->id;
        $log->content = $content;
        $log->save();
        // dd($charge);
      }
    }
    else {

        if ($voucher_code = 'CORE2017' || $voucher_code = 'DESTINY2017') {
    $charge  = $this->user->charge(round($campaign->sale_price * 70), $option);
    $content = [
        'id'            => $charge->id,
        'amount'        => $charge->amount,
        'currency'      => $charge->currency,
        'customer'      => $charge->customer,
        'source_id'     => $charge->source->id,
        'status'        => $charge->status,
        'description'   => $charge->description,
        "receipt_email" => $charge->email,
    ];
    // dd($content, $charge);
    $log          = new Log;
    $log->user_id = ($this->user->id) ? $this->user->id : 0;
    $log->type    = 'charge';
    $log->type_id = $campaign->id;
    $log->content = $content;
    $log->save();
    // dd($charge);
    } else {
    $charge  = $this->user->charge($campaign->sale_price * 100, $option);
    $content = [
        'id'            => $charge->id,
        'amount'        => $charge->amount,
        'currency'      => $charge->currency,
        'customer'      => $charge->customer,
        'source_id'     => $charge->source->id,
        'status'        => $charge->status,
        'description'   => $charge->description,
        "receipt_email" => $charge->email,
    ];
    // dd($content, $charge);
    $log          = new Log;
    $log->user_id = ($this->user->id) ? $this->user->id : 0;
    $log->type    = 'charge';
    $log->type_id = $campaign->id;
    $log->content = $content;
    $log->save();
    // dd($charge);
  }
}

    }
}
