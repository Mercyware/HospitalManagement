<?php

namespace App;

use App\Service\InPatientService;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class Patient extends Model
{
    //

    use HasRoles;
    use FormAccessible;
    use ElasticquentTrait;

    protected $dates = ['date_of_birth'];
    protected $fillable = [
        'name',
        'phone',
        'email',
        'date_of_birth',
        'sex',
        'blood_group',
        'genotype',
        'address',
        'photo',
        'branch_id',
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'phone' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
        'email' => [
            'type' => 'text',
            "analyzer" => "standard",
        ],
    );


    public function getNameAttribute($value)
    {
        return ucwords(strtolower($value));
    }

    public function bills()
    {
        return $this->hasMany(Billing::class);
    }


    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function patientAdmitted()
    {
        return $this->hasOne(InPatient::class, 'patient_id')
            ->where('date_admitted', '<>', null)->where('date_discharged', null);
    }

    public function diagnosis()
    {
        return $this->hasMany(Diagnosis::class, 'patient_id')->orderBy('id', 'DESC');

    }


}
