<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 6:24 PM
 */

namespace App\Service;


use App\Repository\InvoicesRepository;

class InvoicesService
{
    /**
     * @var InvoicesRepository
     */
    private $invoicesRepository;

    public function __construct(InvoicesRepository $invoicesRepository)
    {
        $this->invoicesRepository = $invoicesRepository;
    }



}