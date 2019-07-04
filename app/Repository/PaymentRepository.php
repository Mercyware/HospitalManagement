<?php
/**
 * Created by PhpStorm.
 * User: Automata
 * Date: 1/4/2019
 * Time: 2:57 PM
 */

namespace App\Repository;


use App\DiagnosisPayment;
use App\DiagnosticPayment;
use App\LaboratoryPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PaymentRepository
{
    /**
     * @var DiagnosisPayment
     */
    private $diagnosisPayment;
    /**
     * @var DiagnosticPayment
     */
    private $diagnosticPayment;
    /**
     * @var LaboratoryPayment
     */
    private $laboratoryPayment;

    function __construct(DiagnosisPayment $diagnosisPayment, DiagnosticPayment $diagnosticPayment, LaboratoryPayment $laboratoryPayment)
    {

        $this->diagnosisPayment = $diagnosisPayment;
        $this->diagnosticPayment = $diagnosticPayment;
        $this->laboratoryPayment = $laboratoryPayment;
    }


    /**
     * @param $attributes
     * @return mixed
     */
    public function storeDiagnosisPayment($attributes)
    {

        return $this->diagnosisPayment->create([
            'patient_id' => $attributes->patient_id,
            'date' => $attributes->date,
            'amount' => $attributes->amount,
            'pay_type' => $attributes->pay_type,
            'branch_id' => $attributes->branch_id,
            'collected_by' => $attributes->collected_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function getDiagnosisPayment($branch_id, $start_date, $end_date)
    {
        $payment = $this->diagnosisPayment;
        if ($branch_id != null && $branch_id != "") {
            $payment = $payment->where('branch_id', $branch_id);
        }

        if ($start_date != null && $start_date != "" && $end_date != null && $end_date != "") {
            $payment = $payment->whereBetween('date', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))]);

        }

        return $payment->get();
    }


    public function getPatientDiagnosisPayment($patient_id)
    {
        return $this->diagnosisPayment->where('patient_id', $patient_id)->get();
    }


    public function getPatientDiagnosisPaymentSumTotal($patient_id)
    {
        return $this->diagnosisPayment
            ->where('patient_id', $patient_id)
            ->select(DB::raw('*,(amount) as totalPaid'))
            ->get();


    }

    public function getPatientDiagnosisPaymentById($payment_id)
    {
        return $this->diagnosisPayment->where('id', $payment_id)->get();
    }

    public function getPatientDiagnosisPaymentByDate($date, $patient_id)
    {
        return $this->diagnosisPayment->where('date', $date)
            ->where('patient_id', $patient_id)
            ->selectRaw('*, sum(amount) as amount')
            ->get();
    }

    public function getInvoicePayment($diagnosis_bill_id)
    {
        return $this->diagnosisPayment->where('diagnosis_bill_id', '=', $diagnosis_bill_id)->get();
    }

    //================ daignostic ================
    public function storeDiagnosticPayment($attributes)
    {

        return $this->diagnosticPayment->create([
            'patient_id' => $attributes->patient_id,
            'date' => $attributes->date,
            'amount' => $attributes->amount,
            'pay_type' => $attributes->pay_type,
            'branch_id' => $attributes->branch_id,
            'collected_by' => $attributes->collected_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function getADiagnosticPaymentByPatient($patient_id)
    {
        return $this->diagnosticPayment->where('patient_id', '=', $patient_id)->get();
    }


    public function getPatientDiagnosticPaymentById($payment_id)
    {
        return $this->diagnosticPayment->where('id', $payment_id)->get();
    }

    public function getPatientDiagnosticPaymentByDate($date, $patient_id)
    {
        return $this->diagnosticPayment->where('date', $date)
            ->where('patient_id', $patient_id)
            ->groupBy('diagnostic_result_id')
            ->selectRaw('*, sum(amount) as amount')
            ->get();
    }

    public function getDiagnosticPayment($branch_id, $start_date, $end_date)
    {
        $payment = $this->diagnosticPayment;
        if ($branch_id != null && $branch_id != "") {
            $payment = $payment->where('branch_id', $branch_id);
        }

        if ($start_date != null && $start_date != "" && $end_date != null && $end_date != "") {
            $payment = $payment->whereBetween('date', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))]);

        }

        return $payment->get();
    }


    //Laboratory
    public function getALaboratoryPaymentByPatient($patient_id)
    {
        return $this->laboratoryPayment->where('patient_id', '=', $patient_id)->get();
    }

    //================ Laboratory ================
    public function storeLaboratoryPayment($attributes)
    {

        return $this->laboratoryPayment->create([
            'patient_id' => $attributes->patient_id,

            'date' => $attributes->date,
            'amount' => $attributes->amount,
            'pay_type' => $attributes->pay_type,
            'branch_id' => $attributes->branch_id,
            'collected_by' => $attributes->collected_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function getPatientLaboratoryPaymentByDate($date, $patient_id)
    {
        return $this->laboratoryPayment->where('date', $date)
            ->where('patient_id', $patient_id)
            ->selectRaw('*, sum(amount) as amount')
            ->get();
    }


    public function getLaboratoryPayment($branch_id, $start_date, $end_date)
    {
        $payment = $this->laboratoryPayment;
        if ($branch_id != null && $branch_id != "") {
            $payment = $payment->where('branch_id', $branch_id);
        }

        if ($start_date != null && $start_date != "" && $end_date != null && $end_date != "") {
            $payment = $payment->whereBetween('date', [date('Y-m-d', strtotime($start_date)), date('Y-m-d', strtotime($end_date))]);

        }

        return $payment->get();
    }


}