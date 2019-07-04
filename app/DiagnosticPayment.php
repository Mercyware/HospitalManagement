<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiagnosticPayment extends Model
{
    //
    protected $guarded = [];

    public function diagnosticBill()
    {
        return $this->belongsTo(DiagnosticResults::class, 'diagnostic_result_id');
    }

}
