<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_transaction extends Model
{
    // Eloquent ORM a patient who owns this transaction
    public function patient()
    {
    	return $this->belongsTo('App\Http\Models\Patient');
    }
}
