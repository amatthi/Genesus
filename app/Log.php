<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function getContentAttribute()
    {
        return json_decode($this->attributes['content'], true);
    }

    public function setContentAttribute(array $val)
    {
        $this->attributes['content'] = json_encode($val);
    }
}
