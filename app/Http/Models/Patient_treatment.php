<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Patient_treatment extends Model
{
	 /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Patient_Treatments';
    protected $fillable = ['status'];
}
