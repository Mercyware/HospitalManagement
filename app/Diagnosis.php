<?php

namespace App;

use App\Service\InPatientService;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Diagnosis extends Model
{
    //
    use HasRoles;
    use FormAccessible;


    protected $guarded = [];

    public function patientAdmitted()
    {
        return $this->hasOne(InPatient::class, 'diagnosis_id')
            ;
    }

    public function staff(){
        return $this->belongsTo(User::class,'user_id');
    }
}
