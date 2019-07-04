<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 6:23 AM
 */

namespace App\Repository;


use App\Diagnosis;
use App\DiagnosisPrice;
use Carbon\Carbon;

class DiagnosisRepository
{

    /**
     * @var Diagnosis
     */
    private $diagnosis;

    /**
     * DiagnosisRepository constructor.
     * @param Diagnosis $diagnosis
     */
    public function __construct(Diagnosis $diagnosis)
    {
        $this->diagnosis = $diagnosis;

    }

    /**
     * @param $attributes
     * @param $patient_id
     * @param $diagnosis_type
     * @return mixed
     */
    public function createDiagnosis($attributes, $patient_id, $diagnosis_type)
    {

        return $this->diagnosis->create([
            'diagnosis_date' => $attributes->diagnosis_date,
            'temperature' => $attributes->temperature,
            'pressure' => $attributes->pressure,
            'weight' => $attributes->weight,
            'pulse' => $attributes->pulse,
            'complaint' => $attributes->complaint,
            'drug_history' => $attributes->drug_history,
            'med_history' => $attributes->med_history,
            'social_history' => $attributes->social_history,
            'diagnosis' => $attributes->diagnosis,
            'treatment' => $attributes->treatment,
            'summary' => $attributes->summary,
            'patient_id' => $patient_id,
            'user_id' => auth()->user()->id,
            'diagnosis_type' => $diagnosis_type,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    /**
     * @param $attributes
     * @param $diagnosis_id
     */
    public function updateDiagnosis($attributes, $diagnosis_id)
    {

    }


    /**
     * @param $diagnosis_id
     */
    public function getDiagnosis($diagnosis_id)
    {

    }

    /**
     * @param $patient_id
     * @param $diagnosis_type
     * @param $position
     * @param $item_per_page
     * @return mixed
     */
    public function diagnosisHistory($patient_id, $diagnosis_type, $position, $item_per_page)
    {

        return $this->diagnosis
            ->where('patient_id', $patient_id)
            ->where('diagnosis_type', $diagnosis_type)
            ->orderBy('id', 'desc')
            ->offset($position)
            ->limit($item_per_page)
            ->get();
    }


    public function allDiagnosisHistory()
    {

        return $this->diagnosis
            ->orderBy('id', 'desc')
            ->get();
    }


}