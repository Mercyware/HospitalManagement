<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 1/6/2019
 * Time: 11:28 PM
 */

namespace App\Service;


use App\Repository\DiagnosticRepository;

class DiagnosticService
{
    /**
     * @var DiagnosticRepository
     */
    private $diagnosticRepository;

    public function __construct(DiagnosticRepository $diagnosticRepository)
    {
        $this->diagnosticRepository = $diagnosticRepository;
    }


    public function getAllDiagnostics()
    {
        return $this->diagnosticRepository->getAllDiagnostics();
    }


    public function getADiagnosticTest($name)
    {
        return $this->diagnosticRepository->getADiagnosticTest($name);
    }

    public function createDiagnostic($attributes)
    {
        return $this->diagnosticRepository->createDiagnostic($attributes);
    }

    public function getADiagnosticTestById($test_id)
    {
        return $this->diagnosticRepository->getADiagnosticTestById($test_id);
    }

    public function updateDiagnostic($attributes)
    {
        return $this->diagnosticRepository->updateDiagnostic($attributes);
    }

    public function storeDiagnosticResult($attributes)
    {
        return $this->diagnosticRepository->storeDiagnosticResult($attributes);
    }

    public function getADiagnosticTestByName($name)
    {
        return $this->diagnosticRepository->getADiagnosticTestByName($name);
    }

    public function getADiagnosticResultByPatient($patient_id, $order = false, $date = null)
    {
        return $this->diagnosticRepository->getADiagnosticResultByPatient($patient_id, $order, $date);

    }

    public function getPatientDiagnosticPaymentSumTotal($patient_id)
    {
        return $this->diagnosticRepository->getPatientDiagnosticPaymentSumTotal($patient_id);


    }

    public function updateDiagnosticResult($attributes)
    {
        return $this->diagnosticRepository->updateDiagnosticResult($attributes);
    }


    public function getAllTestsConducted()
    {
        return $this->diagnosticRepository->getAllTestsConducted();
    }
}