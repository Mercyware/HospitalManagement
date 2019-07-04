<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class laboratory extends Model
{
    //
    protected $table = "laboratories";


    protected $guarded = [];

    public function tests()
    {
        return $this->belongsTo(Tests::class, 'test_id');
    }


    public function payments(){
        return $this->hasMany(LaboratoryPayment::class,'laboratory_id');
    }
}
