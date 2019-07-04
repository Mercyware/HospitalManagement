<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/29/2018
 * Time: 8:18 AM
 */

namespace App\Repository;


use App\BloodBank;
use App\BloodBankHistory;
use App\BloodDonor;
use App\BloodGroup;
use Carbon\Carbon;

class BloodBankRepository
{
    /**
     * @var BloodBank
     */
    private $bloodBank;
    /**
     * @var BloodGroup
     */
    private $bloodGroup;
    /**
     * @var BloodBankHistory
     */
    private $bloodBankHistory;
    /**
     * @var BloodDonor
     */
    private $bloodDonor;


    public function __construct(BloodBank $bloodBank, BloodGroup $bloodGroup, BloodBankHistory $bloodBankHistory, BloodDonor $bloodDonor)
    {
        $this->bloodBank = $bloodBank;
        $this->bloodGroup = $bloodGroup;
        $this->bloodBankHistory = $bloodBankHistory;
        $this->bloodDonor = $bloodDonor;
    }


    //Blood Group THings
    public function getBloodGroups()
    {
        return $this->bloodGroup->all();
    }

    public function getABloodGroup($blood_group_id)
    {
        return $this->bloodGroup->where('id', $blood_group_id)->first();
    }


    public function addBloodGroup($attributes)
    {
        return $this->bloodGroup->create([
            'name' => $attributes->name,
            'rh_factor' => $attributes->rh_factor,
            'price' => $attributes->price,
            'qty' => $attributes->qty,
            'created_by' => $attributes->created_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function updateBloodGroup($attributes, $blood_group_id)
    {
        return $this->bloodGroup->where('id', $blood_group_id)->update([
            'name' => $attributes->name,
            'price' => $attributes->price,
            'rh_factor' => $attributes->rh_factor,

            'updated_at' => new Carbon(),
        ]);
    }

    public function increaseBloodBankQty($blood_group_id, $qty)
    {
        $bloodGroup = $this->bloodGroup->where('id', $blood_group_id)->first();

        $bloodGroup->update([

            'qty' => $bloodGroup->qty + $qty,


            'updated_at' => new Carbon(),
        ]);

        return $bloodGroup;
    }

    public function decreaseBloodBankQty($blood_group_id, $qty)
    {
        $bloodGroup = $this->bloodGroup->where('id', $blood_group_id)->first();

        $newQty = $bloodGroup->qty - $qty;

        if ($newQty < 0) {
            return null;
        }

        $bloodGroup->update([

            'qty' => $bloodGroup->qty - $qty,


            'updated_at' => new Carbon(),
        ]);

        return $bloodGroup;
    }


    //Blood Bank Now

    public function getBloodBankDetails()
    {
        return $this->bloodBank->all();
    }

    public function getABloodBankDetail($blood_group_id)
    {
        return $this->bloodBank->where('id', $blood_group_id)->first();
    }


    public function addBloodBank($attributes)
    {
        return $this->bloodBank->create([
            'donor_id' => $attributes->donor_id,
            'created_by' => $attributes->created_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function updateBloodBank($attributes, $blood_bank_id)
    {
        return $this->bloodBank->where('id', $blood_bank_id)->update([
            'name' => $attributes->name,
            'date_of_birth' => $attributes->date_of_birth,
            'date_last_donated' => $attributes->date_last_donated,
            'address' => $attributes->address,
            'mobile' => $attributes->mobile,
            'blood_group_id' => $attributes->blood_group_id,


            'updated_at' => new Carbon(),
        ]);
    }


    //Blood bank History


    public function getBloodBankHistory()
    {
        return $this->bloodBankHistory->all();
    }

    public function getABloodBankHistory($blood_bank_history_id)
    {
        return $this->bloodBankHistory->where('id', $blood_bank_history_id)->first();
    }


    public function addBloodBankHistory($attributes)
    {
        return $this->bloodBankHistory->create([
            'name' => $attributes->name,
            'mobile' => $attributes->mobile,
            'blood_group_id' => $attributes->blood_group_id,
            'details' => $attributes->details,
            'price' => $attributes->price,
            'created_by' => $attributes->created_by,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

    public function updateBloodBankHistory($attributes, $blood_bank_history_id)
    {
        return $this->bloodBankHistory->where('id', $blood_bank_history_id)->update([
            'name' => $attributes->name,
            'mobile' => $attributes->mobile,
            'blood_group_id' => $attributes->blood_group_id,
            'details' => $attributes->details,
            'price' => $attributes->price,


            'updated_at' => new Carbon(),
        ]);
    }


    //Donors

    public function getDonors()
    {
        return $this->bloodDonor->all();
    }

    public function getABloodDonory($donor_id)
    {
        return $this->bloodDonor->where('id', $donor_id)->first();
    }




    public function addBloodDonor($attributes)
    {
        return $this->bloodDonor->create([
            'name' => $attributes->name,
            'mobile' => $attributes->mobile,
            'blood_group_id' => $attributes->blood_group_id,
            'date_of_birth' => $attributes->date_of_birth,
            'address' => $attributes->details,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }

}