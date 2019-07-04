<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 5:23 PM
 */

namespace App\Service;


use App\Repository\StaffRepository;

class StaffService
{
    /**
     * @var StaffRepository
     */
    private $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }


    public function createUser($attributes)
    {
        return $this->staffRepository->createUser($attributes);
    }


    public function getUser($user_id)
    {
        return $this->staffRepository->getUser($user_id);

    }

    public function updateUser($user_id, $attributes)
    {
        return $this->staffRepository->updateUser($user_id, $attributes);

    }


    public function getAllUsers()
    {
        return $this->staffRepository->getAllUsers();

    }

    public function activate($activateCode, $user_id)
    {
        return $this->staffRepository->activate($activateCode, $user_id);
    }
}