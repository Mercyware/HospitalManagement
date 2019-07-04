<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 5:27 PM
 */

namespace App\Service;


use App\Repository\RolesRepository;
use App\Role;

class RolesService
{
    /**
     * @var RolesRepository
     */
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public function getRoles()
    {
        return $this->rolesRepository->getRoles();
    }

    public function getAllRoles()
    {
        return $this->rolesRepository->getRoles();
    }


    public function syncPermissions($attributes, $user)
    {
        // Get the submitted roles
        $roles = $attributes->get('roles', []);
        $permissions = $attributes->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if (!$user->hasAllRoles($roles)) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }

}