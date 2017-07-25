<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_payment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Patient_payments';

    public function patient()
    {
    	$this->belongsTo('App\Http\Models\Patient');
    }
}
