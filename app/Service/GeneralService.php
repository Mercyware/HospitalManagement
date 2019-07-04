<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/27/2018
 * Time: 7:37 PM
 */

namespace App\Service;


class GeneralService
{

    public function convertToSQLDDate($date)
    {
        $splitedDate = explode('/', $date);

        return date('Y-m-d', strtotime(implode('-', array_reverse($splitedDate))));
    }

    public function convertToSQLDDateTime($dateTime)
    {
        $date = \DateTime::createFromFormat('d/m/Y H:i:s', $dateTime);
        return $date->format('Y-m-d H:i:s');
    }
}