<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //

    protected $fillable = [
        'tittle',
        'branch_id',
        'amount',
        'user_id',
        'date_received',

    ];
}
