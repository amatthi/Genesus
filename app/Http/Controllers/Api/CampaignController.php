<?php

namespace App\Http\Controllers\Api;

use App\Campaign;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    protected $purposes = [
        'weight_management' => [
            'name'     => 'Weight Management',
            'formulas' => [
                'green-coffee-bean-extract' => ['name' => 'Green Coffee Bean Extract',
                    'ingredients'                          => [['Green Coffee Bean Extract', 'Weight Loss &#183 Energy', '800 mg']],
                ],
                'raspberry-ketone-burner'   => ['name' => 'Raspberry Ketone Burner',
                    'ingredients'                          => [
                        ['Raspberry Ketones', 'Weight Loss &#183 Energy', '600 mg'],
                    ],
                ],
                'garcinia-cambogia'         => ['name' => 'Garcinia Cambogia (60% Standardized)'],
                'safflower-oil'             => ['name' => 'Safflower Oil (CLA)'],
                'african-mango-cleanse'     => ['name' => 'African Mango Cleanse'],
                'rasberry-ketone-cleanse'   => ['name' => 'Rasberry Ketone Cleanse'],
                'gaba-sleep-aid'            => ['name' => 'GABA Sleep Aid'],
            ],
        ],

        'wellness'          => [
            'name'     => 'Wellness',
            'formulas' => [
                'probiotic-1150'                  => ['name' => 'Probiotic 1150'],
                'omega-3-from-chile'              => ['name' => 'Omega-3 from Chile'],
                'krill-oil'                       => ['name' => 'Krill Oil'],
                'one-tab-daily'                   => ['name' => 'One Tab Daily'],
                'multivitamin-2000'               => ['name' => 'Multivitamin 2000'],
                'multivatmin-2400'                => ['name' => 'Multivatmin 2400'],
                'whole-foods-mutli'               => ['name' => 'Whole Foods Mutli'],
                'lifes-vitality-mutli'            => ['name' => 'Life\'s Vitality Mutli'],
                'turmeric-complex-with-bioperine' => ['name' => 'Turmeric Complex with Bioperine'],
                'vitamin-c'                       => ['name' => 'Vitamin C'],
                'calcium'                         => ['name' => 'Calcium'],
                'b-complex'                       => ['name' => 'B Complex'],
            ],
        ],

        'strength'          => [
            'name'     => 'Strength',
            'formulas' => [
                'l-glutamine'               => ['name' => 'L-Glutamine'],
                'l-arginine'                => ['name' => 'L-Arginine'],
                'l-carnitine-tartrate'      => ['name' => 'L-Carnitine (Tartrate)'],
                'ginger-root'               => ['name' => 'Ginger Root'],
                'ginsing-complex'           => ['name' => 'Ginsing Complex'],
                'nitro-pump'                => ['name' => 'Nitro Pump'],
                'creatine-monohydrate-700'  => ['name' => 'Creatine Monohydrate (700)'],
                'creatine-monohydrate-2500' => ['name' => 'Creatine Monohydrate (2500)'],
            ],
        ],
    ];

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
            'png64'           => 'required',
            'sale_price'      => 'required',
            'description'     => 'required',
            'length'          => 'required',
            'slug'            => 'required|max:255',
            'title'           => 'required|max:255',
        ]);
        $slug = str_slug($request->input('slug'), '-');
        $tmp  = new Campaign();
        if ($tmp->findBySlug($slug)) {
            return response(['slug' => ['The Url has already been taken.']], 422);
        }

        $db_cols       = ['title', 'description', 'goal'];
        $img           = base64_decode(explode(',', $request->input('png64'))[1]);
        $s3            = \Storage::disk('s3');
        $imageFileName = 'lo'.time() .str_random(20) .'.png';
        $filePath      = $imageFileName;
        $s3->put($filePath, $img, 'public');

        $data                         = $request->only($db_cols);
        $data['slug']                 = $slug;
        $data['end_at']               = date('Y-m-d H:i:s', strtotime('+' . $request->input('length') . 'days'));
        $data['others']               = $request->except($db_cols);
        $data['others']['bottle_img'] = $s3->url($filePath);
        unset($data['others']['png64']);
        //var_dump($data);
        //dd();
        return Campaign::create($data);
    }

    function get(Campaign $campaign){
        return $campaign;
    }

    public function purposes()
    {
        return $this->purposes;
    }
}
