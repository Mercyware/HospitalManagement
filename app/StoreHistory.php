<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreHistory extends Model
{
    //


    protected $fillable = [
        'store_id',
        'operation',
        'qty',
        'user_id',
        'reason'
    ];


}
