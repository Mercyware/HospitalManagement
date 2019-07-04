<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/27/2018
 * Time: 7:02 PM
 */

namespace App\Service;


use App\Repository\PatientRepository;

class PatientService
{
    /**
     * @var PatientRepository
     */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function createPatient($attributes)
    {
        return $this->patientRepository->createPatient($attributes);
    }

    public function updatePatient($attributes, $patient_id)
    {
        return $this->patientRepository->updatePatient($attributes, $patient_id);
    }

    /**
     * @param null $branch_id
     * @param null $page
     * @param null $name
     * @return PatientRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllPatient($branch_id = null, $page = null, $name = null)
    {
        return $this->patientRepository->allPatients($branch_id, $page, $name);

    }


    /**
     * @param $patient_id
     * @return mixed
     */
    public function getAPatient($patient_id)
    {
        return $this->patientRepository->getAPatient($patient_id);
    }

}