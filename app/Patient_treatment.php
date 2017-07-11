<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient_treatment extends Model
{
    // Reverse relationship
	public function patient()
	{
		return $this->belongsTo('App\Patient');
	}

	 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Patient_Treatments';
}
