<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/27/2018
 * Time: 7:02 PM
 */

namespace App\Service;


use App\Repository\BranchRepository;


class BranchService
{


    /**
     * @var BranchRepository
     */
    private $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
       
        $this->branchRepository = $branchRepository;
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function createbranch($attributes){
        return $this->branchRepository->createbranch($attributes);
    }

    /**
     * @return branchRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllBranches(){
        return $this->branchRepository->allbranches();

    }


    /**
     * @param $branch_id
     * @return mixed
     */
    public  function getABranch($branch_id){
        return $this->branchRepository->getAbranch($branch_id);
    }

    /**
     * @param $attributes
     * @param $branch_id
     * @return mixed
     */
    public function updateBranch($attributes,$branch_id){
        return $this->branchRepository->updateBranch($attributes, $branch_id);
    }

    /**
     * @param $branch_id
     * @return mixed
     */
    public  function deleteBranch($branch_id){
        return $this->branchRepository->deleteBranch($branch_id);
    }
}