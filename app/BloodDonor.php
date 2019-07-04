<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodDonor extends Model
{
    //

    protected $guarded = [];


    public function bloodGroup()
    {
        return $this->belongsTo(BloodGroup::class);
    }

    public function donationHistory()
    {
        return $this->hasMany(BloodBank::class, 'donor_id', 'id')->orderBy('id','DESC');
    }
}
