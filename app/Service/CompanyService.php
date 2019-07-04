<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/29/2018
 * Time: 2:30 AM
 */

namespace App\Service;


use App\Repository\CompanyRepository;

class CompanyService
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function createContact($attributes)
    {
        return $this->companyRepository->createContact($attributes);
    }


    public function updateCompany($attributes, $company_id)
    {
        return $this->companyRepository->updateCompany($attributes,$company_id);
    }

    public function getACompany()
    {
        return $this->companyRepository->getACompany();
    }
}