<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use App\Traits\CampaignTrait;
use Auth;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    use CampaignTrait;
    public function __construct()
    {

    }

    protected function launch(Request $request)
    {
        $this->validate($request, [
            'goal'            => 'required|max:100|min:0',
            'cost_per_bottle' => 'required',
            'purpose'         => 'required',
            'formula'         => 'required',
            //'png64'           => 'required',
            'sale_price'      => 'required',
            //'description'     => 'required',
            //'length'          => 'required|in:3,4,5,7',
            'status'          => 'required|in:public,draft',
            //'slug'            => 'required|max:255',
            //'blurb'            => 'required|max:255',
            //'title'           => 'required|max:255',
        ]);
        $db_cols = ['goal', 'status'];
        $slug    = str_slug($request->input('slug'), '-');
        $tmp     = Campaign::where('slug', $slug)->first();
        if ($tmp) {
            if ($tmp->id != $request->input('id')) {
                return response(['slug' => ['It looks like you have entered a Product URL (Step 3) that is already taken or the field is not complete. Please enter a new Product URL to continue!']], 422);
            }
        }
        $update_id = $request->input('id');
        if ($update_id) {
            $tmp = Campaign::findOrFail($update_id);
            if ($tmp->user_id != Auth::user()->id) {
                return response(['auth' => ['You are not the owner']], 422);
            }
        }

        if ($request->input('png64')) {
            $img           = base64_decode(explode(',', $request->input('png64'))[1]);
            $s3            = \Storage::disk('s3');
            $imageFileName = 'lo' . time() . str_random(20) . '.png';
            $filePath      = $imageFileName;
            $s3->put($filePath, $img, 'public');
        }

        $data                = $request->only($db_cols);
        $data['title']       = $request->input('title', '');
        $data['description'] = $request->input('description', '');
        $data['blurb']       = $request->input('blurb', '');
        $data['user_id']     = Auth::user()->id;
        $data['slug']        = $slug;
        $data['end_at']      = date('Y-m-d H:i:s', strtotime('+' . $request->input('length') . 'days'));

        $data['others']               = $request->except($db_cols);
        $data['others']['bottle_img'] = isset($s3) ? $s3->url($filePath) : '';
        $data['others']['purpose']    = $data['others']['purpose']['key'];
        $data['others']['formula']    = $data['others']['formula']['sku'];
        unset($data['others']['others']);
        unset($data['others']['png64']);
        return Campaign::updateOrCreate(['id' => $update_id], $data);
    }

    public function update(Campaign $campaign, Request $request)
    {
        if ($campaign->user->id != Auth::user()->id) {
            return response(['auth' => ['You are not the owner']], 422);
        }
        $campaign->title = $request->input('title', '');
        $campaign->blurb = $request->input('blurb', '');
        $campaign->save();
        return $campaign;
    }

    public function get(Campaign $campaign)
    {
        $campaign->orders;
        $campaign->goal_count = count($campaign->orders);
        $campaign->user->profile;
        $campaign->countdown = $campaign->end_at->getTimestamp() - time();
        return $campaign;
    }

    public function purposes()
    {
        // dd($this->_get_purposes());
        return $this->_get_purposes();
    }

    public function dashboard()
    {
        $campaigns = [];
        foreach (Auth::user()->campaigns as $campaign) {
            $campaign->orders;
            $campaign->goal_count = count($campaign->orders);
            unset($campaign->orders);
            $campaigns[] = $campaign;
        }
        return $campaigns;
    }
}
