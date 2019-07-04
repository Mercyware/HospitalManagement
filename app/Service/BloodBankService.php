<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/29/2018
 * Time: 8:52 AM
 */

namespace App\Service;


use App\Repository\BloodBankRepository;

class BloodBankService
{
    /**
     * @var BloodBankRepository
     */
    private $bloodBankRepository;

    public function __construct(BloodBankRepository $bloodBankRepository)
    {


        $this->bloodBankRepository = $bloodBankRepository;
    }


    //Blood Group THings
    public function getBloodGroups()
    {
        return $this->bloodBankRepository->getBloodGroups();
    }

    public function getABloodGroup($blood_group_id)
    {
        return $this->bloodBankRepository->getABloodGroup($blood_group_id);

    }


    public function addBloodGroup($attributes)
    {
        return $this->bloodBankRepository->addBloodGroup($attributes);
    }

    public function updateBloodGroup($attributes, $blood_group_id)
    {
        return $this->bloodBankRepository->updateBloodGroup($attributes, $blood_group_id);
    }

    public function increaseBloodBankQty($blood_group_id, $qty)
    {
        return $this->bloodBankRepository->increaseBloodBankQty($blood_group_id, $qty);
    }

    public function decreaseBloodBankQty($blood_group_id, $qty)
    {
        return $this->bloodBankRepository->decreaseBloodBankQty($blood_group_id, $qty);
    }


    //Blood Bank Now

    public function getBloodBankDetails()
    {
        return $this->bloodBankRepository->getBloodBankDetails();
    }

    public function getABloodBankDetail($blood_group_id)
    {
        return $this->bloodBankRepository->getABloodBankDetail($blood_group_id);
    }


    public function addBloodBank($attributes)
    {
        return $this->bloodBankRepository->addBloodBank($attributes);

    }

    public function updateBloodBank($attributes, $blood_bank_id)
    {
        return $this->bloodBankRepository->updateBloodBank($attributes, $blood_bank_id);
    }


    //Blood bank History


    public function getBloodBankHistory()
    {
        return $this->bloodBankRepository->getBloodBankHistory();

    }

    public function getABloodBankHistory($blood_bank_history_id)
    {
        return $this->bloodBankRepository->getABloodBankHistory($blood_bank_history_id);
    }


    public function addBloodBankHistory($attributes)
    {
        return $this->bloodBankRepository->addBloodBankHistory($attributes);
    }

    public function updateBloodBankHistory($attributes, $blood_bank_history_id)
    {
        return $this->bloodBankRepository->updateBloodBankHistory($attributes, $blood_bank_history_id);
    }



    //Blood Donors
    public function getDonors()
    {
        return $this->bloodBankRepository->getDonors();
    }

    public function getABloodDonory($donor_id)
    {
        return $this->bloodBankRepository->getABloodDonory($donor_id);
    }




    public function addBloodDonor($attributes)
    {
        return $this->bloodBankRepository->addBloodDonor($attributes);
    }
}