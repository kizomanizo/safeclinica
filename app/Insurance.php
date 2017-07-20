<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    /**
     * The patients that have taken specific insurancess
     */
    public function patients()
    {
        return $this->belongsToMany('App\Patient', 'patient_insurances', 'insurance_id', 'patient_id')->withPivot('card')->withTimestamps();
    }
}
