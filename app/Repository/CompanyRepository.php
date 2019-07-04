<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/29/2018
 * Time: 2:31 AM
 */

namespace App\Repository;


use App\contact;
use App\Http\Controllers\ContactController;
use Carbon\Carbon;

class CompanyRepository
{
    /**
     * @var contact
     */
    private $contact;

    public function __construct(contact $contact)
    {
        $this->contact = $contact;
    }


    public function createContact($attributes)
    {
        return $this->contact->create([
            'name' => $attributes->name,
            'phone' => $attributes->phone,
            'email' => $attributes->email,

            'address' => $attributes->address,
            'photo' => $attributes->photo,


            'created_at' => new Carbon(),
            'updated_at' => new Carbon(),
        ]);
    }


    public function updateCompany($attributes, $company_id)
    {
        return $this->contact->where('id', $company_id)->update([
            'name' => $attributes->name,
            'phone' => $attributes->phone,
            'email' => $attributes->email,

            'address' => $attributes->address,
            'photo' => $attributes->photo,



            'updated_at' => new Carbon(),

        ]);
    }

    public function getACompany()
    {
        return $this->contact->first();
    }

}