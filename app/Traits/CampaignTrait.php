<?php

namespace App\Traits;

use Cache;
use File;

trait CampaignTrait
{
    protected $purposes_cache = false;
    protected $purposes_key   = 'purposes-array4';

    protected function _get_purposes()
    {
        if ($this->purposes_cache && Cache::has($this->purposes_key)) {
            return Cache::get($this->purposes_key);
        }
        $file  = File::get(storage_path("csv/Genesus Data & Formula's - Input Data Sheet.csv"));
        $lines = explode(PHP_EOL, $file);
        $array = array();
        foreach ($lines as $line) {
            $array[] = str_getcsv($line);
        }
        $last           = [];
        $result         = [];
        $purpose_i      = -1;
        $formula_i      = 0;
        $ingredients_i  = 0;
        $review_title_i = 0;
        unset($array[0]);
        //dd($array);
        foreach ($array as $index => $row) {
            if (count($row) <= 10) {
                continue;
            }
            $purpose           = $row[0];
            $sku               = $row[1];
            $formula           = $row[2];
            $formula_desc      = $row[3];
            $benefit_1         = $row[4];
            $benefit_2         = $row[5];
            $benefit_3         = $row[6];
            $review_name       = $row[7];
            $cost30            = (float) str_replace('$', '', $row[8]);
            $retail            = (float) str_replace('$', '', $row[9]);
            $review_body       = $row[10];
            $ingredients       = $row[11];
            $recommended_price = (float) str_replace('$', '', $row[12]);
            $servings          = $row[13];
            $review_title      = $row[14];
            $owner             = $row[15];
            $description       = utf8_encode($row[16]);
            $study_name        = $row[17];
            $study_url         = $row[18];
            $benefit_4         = $row[19];
            $benefit_5         = $row[20];
            $benefit_6         = $row[21];
            $instructions      = $row[22];
            $margin            = $row[23];
            $pitch             = $row[24];
            if ($formula) {
                $formula = ['key' => str_slug($formula, '_'), 'name' => $formula, 'instructions' => $instructions, 'cost30' => $cost30, 'cost100' => (float) number_format($cost30 * 0.8, 2), 'cost200' => (float) number_format($cost30 * 0.8 * 0.8, 2), 'ingredients' => [$ingredients], 'servings' => $servings, 'review_title' => [$review_title], 'recommended_price' => $recommended_price, 'retail' => $retail, 'review_body' => [$review_body], 'owner' => $owner, 'sku' => $sku, 'review_name' => [$review_name], 'formula_desc' => $formula_desc, 'benefit_1' => $benefit_1, 'benefit_2' => $benefit_2, 'benefit_3' => $benefit_3, 'benefit_4' => $benefit_4, 'benefit_5' => $benefit_5, 'benefit_6' => $benefit_6, 'description' => [$description], 'study_name' => [$study_name], 'study_url' => [$study_url], 'margin' => $margin, 'pitch' => $pitch];
            } else if ($ingredients) {
                $ingredients_i++;
                $result[$purpose_i]['formulas'][$formula_i]['ingredients'][$ingredients_i]  = $ingredients;
                $result[$purpose_i]['formulas'][$formula_i]['ingredients'][$ingredients_i]  = $ingredients;
                $result[$purpose_i]['formulas'][$formula_i]['description'][$ingredients_i]  = $description;
                $result[$purpose_i]['formulas'][$formula_i]['study_name'][$ingredients_i]   = $study_name;
                $result[$purpose_i]['formulas'][$formula_i]['study_url'][$ingredients_i]    = $study_url;
                continue;
            }
            else if ($review_name) {
               $review_title_i++;
               $result[$purpose_i]['formulas'][$formula_i]['review_name'][$review_title_i]  = $review_name;
               $result[$purpose_i]['formulas'][$formula_i]['review_name'][$review_title_i]  = $review_name;
               $result[$purpose_i]['formulas'][$formula_i]['review_body'][$review_title_i]  = $review_body;
               $result[$purpose_i]['formulas'][$formula_i]['review_title'][$review_title_i] = $review_title;
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
                $review_title_i = 0;
                $formula_i++;
                $result[$purpose_i]['formulas'][$formula_i] = $formula;
            }
        }

        //var_dump($result);
        if ($this->purposes_cache) {
            Cache::put($this->purposes_key, $result, 100);
        }

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
