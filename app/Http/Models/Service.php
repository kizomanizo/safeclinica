<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The patients that have this service.
     */
    public function patients()
    {
        return $this->belongsToMany('App\Http\Models\Patient', 'patient_services', 'service_id', 'patient_id');
    }
}
