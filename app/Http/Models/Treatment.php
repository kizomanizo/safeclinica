<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
	protected $table = 'treatments';
	// Patients that have taken some treatments and yet to pay
    public function patients()
    {
        return $this->belongsToMany('App\Http\Models\Patient', 'patient_treatments', 'treatment_id', 'patient_id')->withPivot('treatment_payment');
    }
}
