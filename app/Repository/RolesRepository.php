<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 5:27 PM
 */

namespace App\Repository;


use App\Role;

class RolesRepository
{
    /**
     * @var Role
     */
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }


    public function getRoles()
    {
        return $this->role->pluck('name', 'id');
    }

    public function getAllRoles()
    {
        return $this->role->all();
    }
}