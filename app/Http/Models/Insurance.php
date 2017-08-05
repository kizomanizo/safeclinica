<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
	protected $table = 'insurances';
    /**
     * The patients that have taken specific insurancess
     */
    public function patients()
    {
        return $this->belongsToMany('App\Http\Models\Patient', 'patient_insurances', 'insurance_id', 'patient_id')->withPivot('card')->withTimestamps();
    }
}
