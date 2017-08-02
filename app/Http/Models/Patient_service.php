<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_service extends Model
{
	 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'patient_services';
    protected $fillable = ['status'];
}
