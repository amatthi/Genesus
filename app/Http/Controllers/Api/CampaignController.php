<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;

class CampaignController extends Controller
{
    protected $purposes = [
        'weight_management' => [
            'name' => 'Weight Management',
            'formulas' => [
                'green-coffee-bean-extract' => ['name' => 'Green Coffee Bean Extract',
                    'ingredients' => [['Green Coffee Bean Extract', 'Weight Loss &#183 Energy', '800 mg']],
                ],
                'raspberry-ketone-burner' => ['name' => 'Raspberry Ketone Burner',
                    'ingredients' => [
                        ['Raspberry Ketones', 'Weight Loss &#183 Energy', '600 mg']
                    ],
                ],
                'garcinia-cambogia' => ['name' => 'Garcinia Cambogia (60% Standardized)'],
                'safflower-oil' => ['name' => 'Safflower Oil (CLA)'],
                'african-mango-cleanse' => ['name' => 'African Mango Cleanse'],
                'rasberry-ketone-cleanse' => ['name' => 'Rasberry Ketone Cleanse'],
                'gaba-sleep-aid' => ['name' => 'GABA Sleep Aid'],
            ],
        ],

        'wellness' => [
            'name' => 'Wellness',
            'formulas' => [
                'probiotic-1150' => ['name' => 'Probiotic 1150'],
                'omega-3-from-chile' => ['name' => 'Omega-3 from Chile'],
                'krill-oil' => ['name' => 'Krill Oil'],
                'one-tab-daily' => ['name' => 'One Tab Daily'],
                'multivitamin-2000' => ['name' => 'Multivitamin 2000'],
                'multivatmin-2400' => ['name' => 'Multivatmin 2400'],
                'whole-foods-mutli' => ['name' => 'Whole Foods Mutli'],
                'lifes-vitality-mutli' => ['name' => 'Life\'s Vitality Mutli'],
                'turmeric-complex-with-bioperine' => ['name' => 'Turmeric Complex with Bioperine'],
                'vitamin-c' => ['name' => 'Vitamin C'],
                'calcium' => ['name' => 'Calcium'],
                'b-complex' => ['name' => 'B Complex'],
            ],
        ],

        'strength' => [
            'name' => 'Strength',
            'formulas' => [
                'l-glutamine' => ['name' => 'L-Glutamine'],
                'l-arginine' => ['name' => 'L-Arginine'],
                'l-carnitine-tartrate' => ['name' => 'L-Carnitine (Tartrate)'],
                'ginger-root' => ['name' => 'Ginger Root'],
                'ginsing-complex' => ['name' => 'Ginsing Complex'],
                'nitro-pump' => ['name' => 'Nitro Pump'],
                'creatine-monohydrate-700' => ['name' => 'Creatine Monohydrate (700)'],
                'creatine-monohydrate-2500' => ['name' => 'Creatine Monohydrate (2500)'],
            ],
        ],
    ];

    public function __construct()
    {

    }

    protected function launch()
    {
        echo 'hi test';
        var_dump(Auth::user());
    }

    public function purposes()
    {
        return $this->purposes;
    }
}
