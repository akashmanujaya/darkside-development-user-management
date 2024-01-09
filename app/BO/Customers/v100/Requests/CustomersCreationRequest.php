<?php

namespace App\BO\Customers\v100\Requests;

use App\Http\Requests\BaseRequest;

class CustomersCreationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'address' => 'required'
        ];
    }
}