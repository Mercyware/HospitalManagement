<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 6:36 AM
 */

namespace App\Repository;


use App\InPatient;
use Carbon\Carbon;

class InPatientRepository
{
    /**
     * @var InPatient
     */
    private $inPatient;

    public function __construct(InPatient $inPatient)
    {
        $this->inPatient = $inPatient;
    }


    /**
     * @param $patient_id
     * @param $diagnosis_id
     * @param $attributes
     * @return mixed
     */
    public function admitPatient($patient_id, $diagnosis_id, $attributes)
    {
        return $this->inPatient->create([
            'patient_id' => $patient_id,
            'diagnosis_id' => $diagnosis_id,
            'date_admitted' => $attributes->date_admitted,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    /**
     * @param $in_patient_id
     * @param $attributes
     * @return mixed
     */
    public function dischargePatient($in_patient_id, $attributes)
    {
        return $this->inPatient->where('id', $in_patient_id)->update([

            'date_discharged' => $attributes->date_discharged,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }
}