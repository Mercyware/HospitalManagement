<?php
/**
 * Created by PhpStorm.
 * User: Automata
 * Date: 1/4/2019
 * Time: 2:57 PM
 */

namespace App\Service;


use App\DiagnosisPayment;
use App\Repository\PaymentRepository;

class PaymentService
{

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    function __construct(PaymentRepository $paymentRepository)
    {

        $this->paymentRepository = $paymentRepository;
    }

    public function storeDiagnosisPayment($attributes)
    {
        return $this->paymentRepository->storeDiagnosisPayment($attributes);
    }


    public function getDiagnosisPayment($branch_id = null, $start_date = null, $end_date = null)
    {
        return $this->paymentRepository->getDiagnosisPayment($branch_id, $start_date, $end_date);
    }


    public function getPatientDiagnosisPayment($patient_id)
    {
        return $this->paymentRepository->getPatientDiagnosisPayment($patient_id);
    }



    public function getPatientDiagnosisPaymentSumTotal($patient_id)
    {
        return $this->paymentRepository->getPatientDiagnosisPaymentSumTotal($patient_id);


    }


    public function getPatientDiagnosisPaymentById($payment_id)
    {
        return $this->paymentRepository->getPatientDiagnosisPaymentById($payment_id);
    }

    public function getPatientDiagnosisPaymentByDate($date, $patient_id)
    {
        return $this->paymentRepository->getPatientDiagnosisPaymentByDate($date, $patient_id);
    }


    //Diagnostic
    public function storeDiagnosticPayment($attributes)
    {

        return $this->paymentRepository->storeDiagnosticPayment($attributes);
    }

    public function getADiagnosticPaymentByPatient($patient_id)
    {
        return $this->paymentRepository->getADiagnosticPaymentByPatient($patient_id);
    }


    public function getInvoicePayment($diagnosis_bill_id)
    {
        return $this->paymentRepository->getInvoicePayment($diagnosis_bill_id);
    }

    public function getPatientDiagnosticPaymentById($payment_id)
    {
        return $this->paymentRepository->getPatientDiagnosticPaymentById($payment_id);
    }

    public function getPatientDiagnosticPaymentByDate($date, $patient_id)
    {
        return $this->paymentRepository->getPatientDiagnosticPaymentByDate($date, $patient_id);
    }

    public function getDiagnosticPayment($branch_id = null, $start_date = null, $end_date = null)
    {
        return $this->paymentRepository->getDiagnosticPayment($branch_id, $start_date, $end_date);
    }


    //Laboratory

    public function getLaboratoryPaymentByPatient($patient_id)
    {
        return $this->paymentRepository->getALaboratoryPaymentByPatient($patient_id);
    }

    public function storeLaboratoryPayment($attributes)
    {

        return $this->paymentRepository->storeLaboratoryPayment($attributes);
    }

    public function getPatientLaboratoryPaymentByDate($date, $patient_id)
    {
        return $this->paymentRepository->getPatientLaboratoryPaymentByDate($date, $patient_id);
    }

    public function getLaboratoryPayment($branch_id = null, $start_date = null, $end_date = null)
    {
        return $this->paymentRepository->getLaboratoryPayment($branch_id, $start_date, $end_date);
    }






}