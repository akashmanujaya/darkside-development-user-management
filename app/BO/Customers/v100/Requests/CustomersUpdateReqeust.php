<?php

namespace App\BO\Customers\v100\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Config;

/**
 * Customer Update Request.
 *
 * This request class handles the validation rules for updating existing customer records.
 * It extends the BaseRequest class and specifies the validation rules that apply
 * when updating a customer's information.
 *
 * Note: The email field validation includes a unique check that excludes the current record,
 * allowing the same email to be submitted if it has not been changed.
 *
 * @package App\BO\Customers\v100\Requests
 */
class CustomersUpdateReqeust extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * This method returns an array of validation rules for updating a customer.
     * The rules include checks for required fields, maximum length constraints,
     * and a unique check for the email field that excludes the current customer record.
     *
     * @return array An array of validation rules.
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:'. Config::get('constants.CUSTOMER_FIRST_NAME_MAX_LENGTH'),
            'last_name' => 'required|max:'. Config::get('constants.CUSTOMER_LAST_NAME_MAX_LENGTH'),
            'email' => 'required|email|unique:customers,email,'.$this->id,
            'phone' => 'required|max:'. Config::get('constants.CUSTOMER_PHONE_MAX_LENGTH'),
            'address' => 'required|max:'. Config::get('constants.CUSTOMER_ADDRESS_MAX_LENGTH')
        ];
    }
}