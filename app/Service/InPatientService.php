<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 7:03 AM
 */

namespace App\Service;


use App\Repository\InPatientRepository;

class InPatientService
{
    /**
     * @var InPatientRepository
     */
    private $inPatientRepository;

    public function __construct(InPatientRepository $inPatientRepository)
    {

        $this->inPatientRepository = $inPatientRepository;
    }

    /**
     * @param $patient_id
     * @param $diagnosis_id
     * @param $attributes
     * @return mixed
     */
    public function admitPatient($patient_id, $diagnosis_id, $attributes)
    {
        return $this->inPatientRepository->admitPatient($patient_id, $diagnosis_id, $attributes);
    }

    /**
     * @param $in_patient_id
     * @param $attributes
     * @return mixed
     */
    public function dischargePatient($in_patient_id, $attributes)
    {
        return $this->inPatientRepository->dischargePatient($in_patient_id, $attributes);

    }
}