<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    //'

    protected $fillable = [
        'drugname',
        'qty',
        'price',
        'branch_id'
    ];




}
