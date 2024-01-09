<?php

namespace App\BO\Customers\v100\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Config;

class CustomersCreationRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|max:'. Config::get('constants.CUSTOMER_FIRST_NAME_MAX_LENGTH'),
            'last_name' => 'required|max:'. Config::get('constants.CUSTOMER_LAST_NAME_MAX_LENGTH'),
            'email' => 'required|email|unique:customers,email|max:'.Config::get('constants.CUSTOMER_EMAIL_MAX_LENGTH'),
            'phone' => 'required|max:'. Config::get('constants.CUSTOMER_PHONE_MAX_LENGTH'),
            'address' => 'required|max:'. Config::get('constants.CUSTOMER_ADDRESS_MAX_LENGTH')
        ];
    }
}