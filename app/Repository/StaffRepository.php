<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 5:23 PM
 */

namespace App\Repository;


use App\User;
use Carbon\Carbon;

class StaffRepository
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function createUser($attributes)
    {
        return $this->user->create(
            [
                'name' => $attributes->name,
                'phone' => $attributes->phone,
                'email' => $attributes->email,
                'dob' => $attributes->date_of_birth,
                'sex' => $attributes->sex,
                'position' => $attributes->position,
                'address' => $attributes->address,
                'appointment_date' => $attributes->appointment_date,
                'branch_id' => $attributes->branch_id,
                'photo' => $attributes->photo,
                'password' => bcrypt($attributes->phone),
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),

            ]);
    }


    public function getUser($user_id)
    {
        return $this->user->where('id', $user_id)->get();
    }

    public function updateUser($user_id, $attributes)
    {
        $user = $this->user->where('id', $user_id);

        if ($attributes->photo == null) {
            $user->update(
                [
                    'name' => $attributes->name,
                    'phone' => $attributes->phone,
                    'email' => $attributes->email,
                    'dob' => $attributes->date_of_birth,
                    'sex' => $attributes->sex,
                    'position' => $attributes->position,
                    'address' => $attributes->address,
                    'appointment_date' => $attributes->appointment_date,
                    'branch_id' => $attributes->branch_id,

                    'created_at' => new Carbon(),
                    'updated_at' => new Carbon(),

                ]);
        } else {
            $user->update(
                [
                    'name' => $attributes->name,
                    'phone' => $attributes->phone,
                    'email' => $attributes->email,
                    'dob' => $attributes->date_of_birth,
                    'sex' => $attributes->sex,
                    'position' => $attributes->position,
                    'address' => $attributes->address,
                    'appointment_date' => $attributes->appointment_date,
                    'branch_id' => $attributes->branch_id,
                    'photo' => $attributes->photo,

                    'created_at' => new Carbon(),
                    'updated_at' => new Carbon(),

                ]);
        }

        return $user;
    }


    public function getAllUsers()
    {
        return $this->user->all();
    }

    public  function activate($activateCode, $user_id){
        return $this->user->where('id', '=', $user_id)
            ->update(['status' => $activateCode]);
        //0 for Deactivate, 1 for Activate
    }
}