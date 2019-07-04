<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaboratoryPayment extends Model
{
    //


    protected $guarded = [];
    public function laboratory()
    {
        return $this->belongsTo(laboratory::class, 'laboratory_id');
    }
}
