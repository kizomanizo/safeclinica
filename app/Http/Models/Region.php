<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    // The districts that belong to this region.
    public function districts()
    {
        return $this->hasMany('App\Http\Models\District', 'region_id');
    }
}
