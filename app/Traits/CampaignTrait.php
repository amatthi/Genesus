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
        //dd($array);
        foreach ($array as $index => $row) {
            if (count($row) <= 10) {
                continue;
            }
            $purpose           = $row[0];
            $sku               = $row[1];
            $formula           = $row[2];
            $benefit_1         = $row[4];
            $benefit_2         = $row[5];
            $benefit_3         = $row[6];
            $back_image        = $row[7];
            $cost30            = (float) str_replace('$', '', $row[8]);
            $ingredients       = $row[11];
            $recommended_price = $row[12];
            $servings          = $row[13];
            $capsules          = $row[14];
            $form_type         = $row[15];
            $description       = utf8_encode($row[16]);
            $study_name        = $row[17];
            $study_url         = $row[18];
            if ($formula) {
                $formula = ['key' => str_slug($formula, '_'), 'name' => $formula, 'cost30' => $cost30, 'cost100' => (float) number_format($cost30 * 0.8, 2), 'cost200' => (float) number_format($cost30 * 0.8 * 0.8, 2), 'ingredients' => [$ingredients], 'servings' => $servings, 'capsules' => $capsules, 'recommended_price' => $recommended_price, 'form_type' => $form_type, 'sku' => $sku, 'back_image' => $back_image, 'benefit_1' => $benefit_1, 'benefit_2' => $benefit_2, 'benefit_3' => $benefit_3, 'description' => [$description], 'study_name' => [$study_name], 'study_url' => [$study_url]];
            } else if ($ingredients) {
                $ingredients_i++;
                $result[$purpose_i]['formulas'][$formula_i]['ingredients'][$ingredients_i] = $ingredients;
                $result[$purpose_i]['formulas'][$formula_i]['ingredients'][$ingredients_i] = $ingredients;
                $result[$purpose_i]['formulas'][$formula_i]['description'][$ingredients_i] = $description;
                $result[$purpose_i]['formulas'][$formula_i]['study_name'][$ingredients_i]  = $study_name;
                $result[$purpose_i]['formulas'][$formula_i]['study_url'][$ingredients_i]   = $study_url;
                continue;
            } else {
                continue;
            }

            if ($purpose) {
                $purpose_i++;
                $formula_i          = 0;
                $result[$purpose_i] = ['key' => str_slug($purpose, '_'), 'name' => $purpose, 'formulas' => [$formula]];
            } else {
                $ingredients_i = 0;
                $formula_i++;
                $result[$purpose_i]['formulas'][$formula_i] = $formula;
            }
        }

        //var_dump($result);
        //Cache::put($this->purposes_key, $result, 100);
        return $result;
    }

    protected function _get_one($key, $type = 'purpose')
    {
        $purposes = $this->_get_purposes();
        foreach ($purposes as $purpose) {
            if ($type == 'purpose' && $purpose['key'] == $key) {
                return $purpose;
            } else if ($type == 'formula') {
                foreach ($purpose['formulas'] as $formula) {
                    if ($formula['sku'] == $key) {
                        return $formula;
                    }
                }
            }
        }
    }
}
