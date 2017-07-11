<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient_service extends Model
{
    // Reverse relationship
	public function patients()
	{
		return $this->belongsTo('App\Patient');
	}

	 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Patient_services';
}
