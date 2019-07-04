<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 1/12/2019
 * Time: 10:16 AM
 */

namespace App\Repository;


use App\laboratory;
use App\Tests;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaboratoryRepository
{
    /**
     * @var Tests
     */
    private $tests;
    /**
     * @var laboratory
     */
    private $laboratory;

    public function __construct(Tests $tests, laboratory $laboratory)
    {
        $this->tests = $tests;
        $this->laboratory = $laboratory;
    }

    public function createTest($attributes)
    {

        return $this->tests->create([
            'name' => $attributes->name,
            'normal_range' => $attributes->normal_range,
            'parent_id' => $attributes->parent_id,
            'price' => $attributes->price,
            'unit' => $attributes->unit,
        ]);

    }

    public function allTest($parent_id)
    {
        $test = $this->tests;
//        if ($parent_id > 0) {
        $test = $test->where('parent_id', $parent_id);

        /// }
        return $test->get();

    }

    public function allParentTest()
    {
        return $this->tests->where('parent_id', 0)->get();

    }

    public function updateTest($attributes)
    {

        return $this->tests->where('id', $attributes->id)->update([
            'name' => $attributes->name,
            'normal_range' => $attributes->normal_range,
            'parent_id' => $attributes->parent_id,
            'price' => $attributes->price,
            'unit' => $attributes->unit,
        ]);

    }

    public function getATest($test_id)
    {
        return $this->tests->where('id', $test_id)->first();
    }


    public function createPatientTest($attributes)
    {

        return $this->laboratory->create([
            'date' => $attributes->date,
            'patient_id' => $attributes->patient_id,
            'test_id' => $attributes->test_id,
            'test_name' => $attributes->test_name,
            'result' => $attributes->result,
            'normal_range' => $attributes->normal_range,
            'price' => $attributes->price,
            'discount' => $attributes->discount,
            'charged_by' => $attributes->charged_by,

        ]);

    }


    public function getALaboratoryResultByPatient($patient_id, $order, $date)
    {

        $test = $this->laboratory->where('patient_id', '=', $patient_id);

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
        return $this->laboratory
            ->where('patient_id', $patient_id)
            ->select(DB::raw('*,(price+discount) as price'))
            ->get();


    }


    public function updateLaboratoryResult($attributes)
    {
        return $this->laboratory->where('id', $attributes->test_id)->update([


            // 'test_id' => $attributes->test_id,
            'result' => $attributes->result,
            'normal_range' => $attributes->normal_range,
            //   'price' => $attributes->price,
            'discount' => $attributes->discount,
            'charged_by' => $attributes->created_by,

            'updated_at' => new Carbon(),
        ]);
    }


    public function getAllTestsConducted()
    {
        return $this->laboratory ->orderBy('id', 'desc')
            ->get();
    }

}