<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //

    public $timestamps = false;

    protected $fillable = [
        'patient_id',
        'bill_title',
        'bill_date',
        'amount',
        'user_id',
        'paytype',
        'branch_id',
        'date_received'
    ];


    public function patient()
    {
        return $this->belongsToMany(Patient::class);
    }

}
