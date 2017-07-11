<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	/**
     * Get the relationships that belongs to the patient.
     */
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function patient_treatments()
    {
        return $this->hasMany('App\Patient_treatment');
    }

    public function patient_services()
    {
        return $this->hasMany('App\Patient_service');
    }

    public function patient_investigations()
    {
        return $this->hasMany('App\Patient_investigation');
    }
}
