<?php

namespace App;

use App\Service\PatientService;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //

    protected $dates = [
        'appointment_date'
    ];

    protected $fillable = [
        'patient_id',
        'appointment_date',
        'user_id',
        'branch_id',
        'doc_id'
    ];

    public function doctor(){
        return $this->belongsTo(User::class,'doc_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_id');
    }
}
