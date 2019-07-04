<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tooth extends Model
{
    //
    protected $fillable = [
        'patient_id',
        'tooth_position',
        'tooth_number',
        'tooth_status',
    ];

}
