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
            'length'          => 'required',
            //'slug'            => 'required|max:255',
            //'title'           => 'required|max:255',
        ]);
        $db_cols = ['goal'];
        $slug    = str_slug($request->input('slug'), '-');
        $tmp     = Campaign::where('slug', $slug)->first();
        if ($tmp) {
            if ($tmp->id != $request->input('id')) {
                return response(['slug' => ['Please enter a url on Step 3 to Save!']], 422);
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
        $data['title']       = ($request->input('title')) ? $request->input('title') : '';
        $data['description'] = ($request->input('description')) ? $request->input('description') : '';
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

    public function get(Campaign $campaign)
    {
        $campaign->orders;
        $campaign->goal_count = count($campaign->orders);
        return $campaign;
    }

    public function purposes()
    {
        return $this->_get_purposes();
    }

    public function dashboard()
    {
        return Auth::user()->campaigns;
    }
}
