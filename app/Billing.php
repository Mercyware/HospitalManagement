<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    //

    public $timestamps = false;


    protected $guarded = [];


    public function patient()
    {
        return $this->belongsToMany(Patient::class);
    }


}
