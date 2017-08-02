<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
	protected $table = ['investigations'];
        /**
     * The patients that have taken specific investigations
     */
    public function patients()
    {
        return $this->belongsToMany('App\Http\Models\Patient', 'patient_investigations', 'investigation_id', 'patient_id');
    }

}
