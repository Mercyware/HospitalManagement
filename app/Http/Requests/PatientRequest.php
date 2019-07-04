<?php

namespace App\Http\Requests;

use App\Patient;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:patients,name',
//            'phone' => 'required',
//            'email' =>  'email|unique:patients,email',
        ];
    }


    public function persist()
    {


        // dd($PhotoName);
        $DoB = request('dob');
//        dd(Carbon::parse($DoB)->format('Y-m-d'));

        $patient = Patient::create(
            [
                'name' => request('name'),
                'phone' => request('phone'),
                'email' => request('email'),
                'dob' => (Carbon::parse($DoB)->format('Y-m-d')),
                'sex' => request('sex'),
                'bloodgroup' => request('bloodgroup'),
                'genotype' => request('genotype'),
                'address' => request('address'),

            ]);


    }
}
