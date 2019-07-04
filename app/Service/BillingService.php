<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 1/3/2019
 * Time: 7:15 PM
 */

namespace App\Service;


use App\Repository\BillingRepository;

class BillingService
{

    /**
     * @var BillingRepository
     */
    private $billingRepository;

    public function __construct(BillingRepository $billingRepository)
    {

        $this->billingRepository = $billingRepository;
    }


    /**
     * Get Diagnosis Prices List
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function diagnosisPrices()
    {
        return $this->billingRepository->diagnosisPrices();
    }

    /**
     * Create Diagnosis Prices
     * @param $attributes
     * @return mixed
     */
    public function createDiagnosisPrice($attributes)
    {
        return $this->billingRepository->createDiagnosisPrice($attributes);
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

        return $this->billingRepository->storeGeneralBillings($attributes);
    }


    public function getDiagnosisBills()
    {

        return $this->billingRepository->getDiagnosisBills();
    }

    public function getADiagnosisBills($bill_id)
    {

        return $this->billingRepository->getADiagnosisBills($bill_id);
    }


    public function getPatientDiagnosisBills($patient_id)
    {

        return $this->billingRepository->getPatientDiagnosisBills($patient_id);
    }


    public function getPatientDiagnosisBilSumTotal($patient_id)
    {

        return $this->billingRepository->getPatientDiagnosisBilSumTotal($patient_id);
    }


    public function getPatientDiagnosisBillByDate($patient_id, $bill_date)
    {

        return $this->billingRepository->getPatientDiagnosisBillByDate($patient_id, $bill_date);
    }

    //Store Prices
    public function storePrices($attributes)
    {
        return $this->billingRepository->storeDiagnosisBillings($attributes);
    }

    public function updatePrices($attributes)
    {
        return $this->billingRepository->updateDiagnosisBillings($attributes);
    }


    //========== General Billing ==//
    public function storeBillings($attributes)
    {
        return $this->billingRepository->storeGeneralBillings($attributes);
    }
}