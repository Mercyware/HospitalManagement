<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drugs_History extends Model
{
    //

    protected $fillable = [
        'drug_id',
        'operation',
        'qty',
        'user_id',
        'reason'
    ];

}
