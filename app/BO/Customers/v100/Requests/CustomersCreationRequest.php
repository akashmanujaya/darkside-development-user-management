<?php

namespace App\BO\Customers\v100\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Config;

/**
 * Customer Creation Request.
 *
 * This request class handles the validation rules for creating a new customer.
 * It extends the BaseRequest class and specifies the validation rules
 * that apply when a new customer is being created.
 *
 * @package App\BO\Customers\v100\Requests
 */
class CustomersCreationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * This method returns an array of validation rules for customer creation.
     * It utilizes configuration values to define constraints like max length.
     *
     * @return array An array of validation rules.
     */
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