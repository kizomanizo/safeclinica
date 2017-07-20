<?php

namespace App;

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
    	$this->belongsTo('App\Patient');
    }
}
