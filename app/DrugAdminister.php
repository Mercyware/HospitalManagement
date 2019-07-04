<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugAdminister extends Model
{
    //
    public $timestamps = false;


    protected $fillable = [
        'patient_id',
        'user_id',
        'drug_id',
        'usage',
        'date_created'
    ];


}
