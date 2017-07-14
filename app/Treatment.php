<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
	// Patients that have taken some treatments and yet to pay
    public function patients()
    {
        return $this->belongsToMany('App\Patient', 'patient_treatments', 'treatment_id', 'patient_id');
    }
}
