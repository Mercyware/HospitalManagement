<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    //
    protected $fillable = [
        'store_id',
        'qty',
        'description',
        'user_id'
    ];
}
