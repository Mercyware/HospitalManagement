<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/27/2018
 * Time: 7:02 PM
 */

namespace App\Repository;


use App\Patient;
use phpDocumentor\Reflection\Types\This;
use Carbon\Carbon;

class PatientRepository
{

    /**
     * @var Patient
     */
    private $patient;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function allPatients($branch_id, $page, $name)
    {

        $patients = $this->patient;

        if ($branch_id) {
            $patients = $patients->where('branch_id', $branch_id);
        }

        if($name!=null){
            $patients = $patients->where('name','LIKE',"%$name%");

        }

        if ($page > 0) {
            $item_per_page = 6;

            $position = (($page - 1) * $item_per_page);

            $patients = $patients->offset($position)
                ->limit($item_per_page)
                ->orderBy('name', "ASC");
        }


        return $patients->get();
    }

    public function allActivePatients()
    {
        return $this->patient->where('is_active')->all();
    }

    public function createPatient($attributes)
    {


        return $this->patient->create([
            'name' => $attributes->name,
            'phone' => $attributes->phone,
            'email' => $attributes->email,
            'date_of_birth' => $attributes->date_of_birth,
            'sex' => $attributes->sex,
            'blood_group' => $attributes->blood_group,
            'genotype' => $attributes->genotype,
            'address' => $attributes->address,
            'photo' => $attributes->photo,
            'branch_id' => $attributes->branch_id,
            'is_active' => true,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function updatePatient($attributes, $patient_id)
    {
        $patient = $this->patient->where('id', $patient_id);
        if ($attributes->photo != "" && $attributes->photo != null) {
            $patient->update([
                'name' => $attributes->name,
                'phone' => $attributes->phone,
                'email' => $attributes->email,
                'date_of_birth' => $attributes->date_of_birth,
                'sex' => $attributes->sex,
                'blood_group' => $attributes->blood_group,
                'genotype' => $attributes->genotype,
                'address' => $attributes->address,

                'branch_id' => $attributes->branch_id,

                'updated_at' => new Carbon(),

            ]);
        } else {
            $patient->update([
                'name' => $attributes->name,
                'phone' => $attributes->phone,
                'email' => $attributes->email,
                'date_of_birth' => $attributes->date_of_birth,
                'sex' => $attributes->sex,
                'blood_group' => $attributes->blood_group,
                'genotype' => $attributes->genotype,
                'address' => $attributes->address,
                'photo' => $attributes->photo,

                'branch_id' => $attributes->branch_id,

                'updated_at' => new Carbon(),

            ]);
        }

        return $patient;
    }

    public function deletePatient($patient_id)
    {
        return $this->patient->where('id', $patient_id)->update([
            'is_active' => false,

            'updated_at' => new Carbon(),

        ]);
    }

    public function getAPatient($patient_id)
    {
        return $this->patient->where('id', $patient_id)->first();
    }
}