<?php

namespace App;

use App\Traits\CampaignTrait;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use CampaignTrait;

    protected $fillable = ['title', 'goal', 'slug', 'description', 'end_at', 'others', 'user_id'];
    protected $appends  = ['cost_per_bottle', 'purpose', 'formula', 'sale_price', 'length', 'bottle_img', 'blend_name'];

    public function findBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function getBlendNameAttribute()
    {
        return isset($this->others['blend_name']) ? $this->others['blend_name'] : '';
    }

    public function getCostPerBottleAttribute()
    {
        return $this->others['cost_per_bottle'];
    }

    public function getPurposeAttribute()
    {
        return $this->_get_one($this->others['purpose'], 'purpose');
    }

    public function getFormulaAttribute()
    {
        return $this->_get_one($this->others['formula'], 'formula');
    }

    public function getSalePriceAttribute()
    {
        return (float) $this->others['sale_price'];
    }

    public function getLengthAttribute()
    {
        return $this->others['length'];
    }

    public function getBottleImgAttribute()
    {
        return $this->others['bottle_img'];
    }

    public function getOthersAttribute()
    {
        return json_decode($this->attributes['others'], true);
    }

    public function setOthersAttribute(array $val)
    {
        $this->attributes['others'] = json_encode($val);
    }
}
