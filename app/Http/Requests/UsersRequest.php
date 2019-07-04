<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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


        $userId = auth()->user()->id;

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required',
                    'phone' => 'required',
                    'position' => 'required',
                    'branch_id' => 'required',
                    'email' => 'email|unique:users,email',
                    'roles' => 'required|min:1'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required',
                    'phone' => 'required',
                    'position' => 'required',
                    'branch_id' => 'required',
                    'email' => 'required|email|unique:users,id,:id',
                ];
            }
            default:
                break;
        }
    }
}
