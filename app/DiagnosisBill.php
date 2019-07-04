<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiagnosisBill extends Model
{
    //
    protected $guarded = [];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


    public function payments()
    {
        return $this->hasMany(DiagnosisPayment::class);
    }


}
