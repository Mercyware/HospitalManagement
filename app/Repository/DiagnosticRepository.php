<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 1/6/2019
 * Time: 11:14 PM
 */

namespace App\Repository;


use App\Diagnostic;
use App\DiagnosticPayment;
use App\DiagnosticResults;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DiagnosticRepository
{
    /**
     * @var Diagnostic
     */
    private $diagnostic;
    /**
     * @var DiagnosticResults
     */
    private $diagnosticResults;
    /**
     * @var DiagnosticPayment
     */
    private $diagnosticPayment;

    public function __construct(Diagnostic $diagnostic, DiagnosticResults $diagnosticResults, DiagnosticPayment $diagnosticPayment)
    {

        $this->diagnostic = $diagnostic;
        $this->diagnosticResults = $diagnosticResults;
        $this->diagnosticPayment = $diagnosticPayment;
    }

    public function getAllDiagnostics()
    {
        return $this->diagnostic->all();
    }


    public function getADiagnosticTest($name)
    {

        return $this->diagnostic->where('name', 'like', "{$name}%")
            ->limit(5)
            ->get();
    }

    public function getADiagnosticTestById($test_id)
    {
        return $this->diagnostic->where('id', '=', $test_id)->first();
    }

    public function getADiagnosticTestByName($name)
    {
        return $this->diagnostic->where('name', '=', $name)->first();
    }

    public function createDiagnostic($attributes)
    {
        return $this->diagnostic->create([
            'name' => $attributes->name,

            'price' => $attributes->price,
            'normal_range' => $attributes->normal_range,

            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function updateDiagnostic($attributes)
    {
        return $this->diagnostic->where('id', $attributes->id)->update([
            'name' => $attributes->name,

            'price' => $attributes->price,
            'normal_range' => $attributes->normal_range,

            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function storeDiagnosticResult($attributes)
    {
        return $this->diagnosticResults->create([
            'date' => $attributes->date,
            'patient_id' => $attributes->patient_id,
            'diagnostic_id' => $attributes->diagnostic_id,
            'result' => $attributes->result,
            'normal_range' => $attributes->normal_range,
            'is_file' => $attributes->is_file,
            'price' => $attributes->price,
            'discount' => $attributes->discount,

            'created_by' => $attributes->created_by,

            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function getADiagnosticResultByPatient($patient_id, $order, $date)
    {
        $test = $this->diagnosticResults->where('patient_id', '=', $patient_id);
        if ($date != null) {
            $test = $test->where('date', $date);
        }
        if ($order) {
            $test = $test->orderBy('id', 'DESC');
        }

        return $test->get();
    }


    public function getPatientDiagnosticPaymentSumTotal($patient_id)
    {
        return $this->diagnosticResults
            ->where('patient_id', $patient_id)
            ->select(DB::raw('*,(price+discount) as price'))
            ->get();


    }

    public function updateDiagnosticResult($attributes)
    {
        return $this->diagnosticResults->where('id', $attributes->test_id)->update([


            'diagnostic_id' => $attributes->diagnostic_id,
            'result' => $attributes->result,
            'normal_range' => $attributes->normal_range,
            'is_file' => $attributes->is_file,
            'price' => $attributes->price,
            'discount' => $attributes->discount,

            'created_by' => $attributes->created_by,

            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function getAllTestsConducted()
    {
        return $this->diagnosticResults ->orderBy('id', 'desc')
            ->get();
    }

}