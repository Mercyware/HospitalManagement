<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patient;

class DiagnosticResults extends Model
{
    //
    protected $guarded =[];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function diagnostic()
    {
        return $this->belongsTo(Diagnostic::class);
    }


    public function payments(){
        return $this->hasMany(DiagnosticPayment::class,'diagnostic_result_id');
    }
}
