<?php

namespace App\Traits;

use Cache;
use File;

trait CampaignTrait
{
    protected $purposes_key = 'purposes-array4';

    protected function _get_purposes()
    {
        if (Cache::has($this->purposes_key)) {
            return Cache::get($this->purposes_key);
        }
        $file  = File::get(storage_path("csv/Genesus Data & Formula's - Input Data Sheet.csv"));
        $lines = explode(PHP_EOL, $file);
        $array = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }
        $last          = [];
        $result        = [];
        $purpose_i     = -1;
        $formula_i     = 0;
        $ingredients_i = 0;
        unset($array[0]);
        foreach ($array as $index => $row) {
            $purpose     = $row[0];
            $sku         = $row[1];
            $formula     = $row[2];
            $cost30      = (float) str_replace('$', '', $row[3]);
            $ingredients = $row[6];
            $servings    = $row[7];
            $capsules    = $row[8];
            $form_type   = $row[9];
            $description = $row[10];
            if ($formula) {
                $formula = ['key' => str_slug($formula, '_'), 'name' => $formula, 'cost30' => $cost30, 'cost100' => (float) number_format($cost30 * 0.8, 2), 'cost200' => (float) number_format($cost30 * 0.8 * 0.8, 2), 'ingredients' => [$ingredients], 'servings' => $servings, 'capsules' => $capsules, 'form_type' => $form_type, 'sku' => $sku, 'description' => [$description]];
            } else if ($ingredients) {
                $ingredients_i++;
                $result[$purpose_i]['formulas'][$formula_i]['ingredients'][$ingredients_i] = $ingredients;
                $result[$purpose_i]['formulas'][$formula_i]['description'][$ingredients_i] = $description;
                continue;
            } else {
                continue;
            }

            if ($purpose) {
                $purpose_i++;
                $result[$purpose_i] = ['key' => str_slug($purpose, '_'), 'name' => $purpose, 'formulas' => [$formula]];
            } else {
                $formula_i++;
                $result[$purpose_i]['formulas'][$formula_i] = $formula;
            }
        }
        Cache::put($this->purposes_key, $result, 100);
        return $result;
    }
}
