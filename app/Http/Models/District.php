<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    // This district belongs to this region.
    public function region()
    {
        return $this->belongsTo('App\Http\Models\Region', 'region_id');
    }

    // The patients that belong to this district.
    public function patients()
    {
        return $this->hasMany('App\Http\Models\Patient', 'district_id');
    }
}
