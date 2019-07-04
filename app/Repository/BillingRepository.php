<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 1/3/2019
 * Time: 7:15 PM
 */

namespace App\Repository;


use App\Billing;
use App\DiagnosisBill;
use App\DiagnosisPayment;
use App\DiagnosisPrice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BillingRepository
{
    /**
     * @var DiagnosisPayment
     */
    private $diagnosisPrice;
    /**
     * @var Billing
     */
    private $billing;
    /**
     * @var DiagnosisBill
     */
    private $diagnosisBill;

    public function __construct(DiagnosisPrice $diagnosisPrice,

                                DiagnosisBill $diagnosisBill,
                                Billing $billing
    )
    {
        $this->diagnosisPrice = $diagnosisPrice;

        $this->billing = $billing;
        $this->diagnosisBill = $diagnosisBill;
    }

    /**
     * Patient Diagnosis Prices Methods
     */

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function diagnosisPrices()
    {
        return $this->diagnosisPrice->all();
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function createDiagnosisPrice($attributes)
    {
        return $this->diagnosisPrice->create([
            'name' => $attributes->name,
            'price' => $attributes->price,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    /**
     * Patient Diagnosis Billing **/

    /**
     * To Store Diagnosis Bill
     * @param $attributes
     * @return mixed
     */
    public function storeDiagnosisBillings($attributes)
    {

        return $this->diagnosisBill->create([
            'date' => $attributes->date,
            'patient_id' => $attributes->patient_id,
            'name' => $attributes->name,
            'price' => $attributes->price,
            'qty' => $attributes->qty,
            'discount' => $attributes->discount,

            'charged_by' => $attributes->charged_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function updateDiagnosisBillings($attributes)
    {

        return $this->diagnosisBill->where('id', $attributes->bill_id)->update([


            'qty' => $attributes->qty,
            'discount' => $attributes->discount,

            'charged_by' => $attributes->charged_by,

            'updated_at' => new Carbon(),
        ]);
    }

    public function getDiagnosisBills()
    {

        return $this->diagnosisBill->all();
    }

    public function getADiagnosisBills($bill_id)
    {

        return $this->diagnosisBill->findorfail($bill_id);
    }

    public function getPatientDiagnosisBills($patient_id)
    {

        return $this->diagnosisBill->where('patient_id', $patient_id)->get();
    }

    public function getPatientDiagnosisBilSumTotal($patient_id)
    {
        $bills = $this->diagnosisBill
            ->where('patient_id', $patient_id)
            ->select(DB::raw('*,(price*qty+discount) as totalPrice'))
            ->get();

        return $bills;
    }

    public function getPatientDiagnosisBillByDate($patient_id, $bill_date)
    {

        return $this->diagnosisBill->where('patient_id', $patient_id)
            ->where('date', $bill_date)->get();
    }





    /**
     * Patient Bills ---
     **/

    /**
     * Store Patient Billing info into General Billing Table
     * @param $attributes
     * @return mixed
     */
    public function storeGeneralBillings($attributes)
    {

        return $this->billing->create([
            'patient_id' => $attributes->patient_id,
            'bill_title' => $attributes->title,
            'qty' => $attributes->qty,
            'amount' => $attributes->amount,
            'user_id' => $attributes->user_id,
            'date_received' => $attributes->date,
            'discount' => $attributes->discount,
            'is_subtract_discount' => $attributes->is_subtract_discount,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }
}