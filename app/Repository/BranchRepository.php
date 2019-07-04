<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/27/2018
 * Time: 7:17 PM
 */

namespace App\Repository;


use App\Branch;
use Carbon\Carbon;

class BranchRepository
{

    /**
     * @var Branch
     */
    private $branch;

    public function __construct(Branch $branch)
    {
       
        $this->branch = $branch;
    }

    public function allBranches()
    {
        return $this->branch->all();
    }


    public function createBranch($attributes)
    {
        return $this->branch->create([
            'name' => $attributes->name,
            'phone' => $attributes->phone,
            'email' => $attributes->email,

            'address' => $attributes->address,

            'is_active' => true,
            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function updateBranch($attributes, $branch_id)
    {
        return $this->branch->where('id', $branch_id)->update([
            'name' => $attributes->name,
            'phone' => $attributes->phone,
            'email' => $attributes->email,

            'address' => $attributes->address,



            'updated_at' => new Carbon(),

        ]);
    }

    public function deleteBranch($branch_id)
    {
        return $this->branch->where('id', $branch_id)->update([
            'is_active' => false,

            'updated_at' => new Carbon(),

        ]);
    }

    public function getABranch($branch_id)
    {
        return $this->branch->where('id', $branch_id)->first();
    }

}