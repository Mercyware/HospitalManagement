<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugsPurchase extends Model
{
    //

    protected $fillable = [
        'patient_id',
        'user_id',
        'drug_id',
        'qty',
        'price'
    ];
}
