<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodBankHistory extends Model
{
    //
    protected $guarded =[];


    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }
}
