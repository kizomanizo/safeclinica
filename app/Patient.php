<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
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
        return $this->belongsToMany('App\Treatment', 'patient_treatments', 'patient_id', 'treatment_id');
    }

    /**
     * The treatments that belong to this patient.
     */
    public function investigations()
    {
        return $this->belongsToMany('App\Investigation', 'patient_investigations', 'patient_id', 'investigation_id');
    }
}
