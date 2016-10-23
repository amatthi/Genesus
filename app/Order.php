<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
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
