<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 1/12/2019
 * Time: 10:42 AM
 */

namespace App\Service;


use App\Repository\LaboratoryRepository;
use App\Tests;

class LaboratoryService
{
    /**
     * @var LaboratoryRepository
     */
    private $laboratoryRepository;

    public function __construct(LaboratoryRepository $laboratoryRepository)
    {
        $this->laboratoryRepository = $laboratoryRepository;
    }

    public function createTest($attributes)
    {
        return $this->laboratoryRepository->createTest($attributes);

    }

    public function allTest($parent_id = 0)
    {
        return $this->laboratoryRepository->allTest($parent_id);
    }


    public function updateTest($attributes)
    {

        return $this->laboratoryRepository->updateTest($attributes);

    }

    public function allParentTest()
    {
        return $this->laboratoryRepository->allParentTest();

    }


    public function getATest($test_id)
    {
        return $this->laboratoryRepository->getATest($test_id);
    }

    public function createPatientTest($attributes)
    {

        return $this->laboratoryRepository->createPatientTest($attributes);
    }

    public function getALaboratoryResultByPatient($patient_id, $order = true, $date = null)
    {
        return $this->laboratoryRepository->getALaboratoryResultByPatient($patient_id, $order, $date);
    }

    public function updateLaboratoryResult($attributes)
    {
        return $this->laboratoryRepository->updateLaboratoryResult($attributes);
    }


    public function getPatientDiagnosticPaymentSumTotal($patient_id)
    {
        return $this->laboratoryRepository->getPatientDiagnosticPaymentSumTotal($patient_id);


    }

    public function getAllTestsConducted()
    {
        return $this->laboratoryRepository->getAllTestsConducted();
    }
}