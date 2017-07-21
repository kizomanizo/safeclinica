<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['status'];
    /**
     * The services that belong to this patient.
     */
    public function services()
    {
        return $this->belongsToMany('App\Service', 'patient_services', 'patient_id', 'service_id');
    }

    /**
     * The treatments that belong to this patient.
     */
    public function treatments()
    {
        return $this->belongsToMany('App\Treatment', 'patient_treatments', 'patient_id', 'treatment_id')->withPivot('treatment_payment');
    }

    /**
     * The investigations that belong to this patient.
     */
    public function investigations()
    {
        return $this->belongsToMany('App\Investigation', 'patient_investigations', 'patient_id', 'investigation_id')->withPivot('status');
    }
    /**
     * The insurances that belong to this patient.
     */
    public function insurances()
    {
        return $this->belongsToMany('App\Insurance', 'patient_insurances', 'patient_id', 'insurance_id')->withPivot('card')->withTimestamps();
    }

    // For the transactions a user pakes
    public function transactions()
    {
        return $this->hasMany('App\Patient_transaction');
    }

    public function patient_payments()
    {
        $this->hasMany('App\Patient_payment');
    }
}
