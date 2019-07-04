<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 6:25 AM
 */

namespace App\Service;


use App\Repository\DiagnosisRepository;

class DiagnosisService
{
    /**
     * @var DiagnosisRepository
     */
    private $diagnosisRepository;

    public function __construct(DiagnosisRepository $diagnosisRepository)
    {
        $this->diagnosisRepository = $diagnosisRepository;
    }

    /***
     * @param $attributes
     * @param $patient_id
     * @param int $diagnosis_type
     * @return mixed
     */
    public function createDiagnosis($attributes, $patient_id, $diagnosis_type = 1)
    {

        return $this->diagnosisRepository->createDiagnosis($attributes, $patient_id, $diagnosis_type);


    }


    /**
     * @param $attributes
     * @param $diagnosis_id
     * @return mixed
     */
    public function updateDiagnosis($attributes, $diagnosis_id)
    {
        return $this->updateDiagnosis($attributes, $diagnosis_id);
    }


    /**
     * @param $diagnosis_id
     * @return mixed
     */
    public function getDiagnosis($diagnosis_id)
    {
        return $this->getDiagnosis($diagnosis_id);
    }

    /**
     * @param $patient_id
     * @param $diagnosis_type
     * @param $page
     * @param int $item_per_page
     * @return mixed
     */
    public function diagnosisHistory($patient_id, $diagnosis_type, $page, $item_per_page = 4)
    {


        $position = (($page - 1) * $item_per_page);

        return $this->diagnosisRepository->diagnosisHistory($patient_id, $diagnosis_type, $position, $item_per_page);

    }

    /**
     * @return DiagnosisRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allDiagnosisHistory()
    {

        return $this->diagnosisRepository->allDiagnosisHistory();
    }

}