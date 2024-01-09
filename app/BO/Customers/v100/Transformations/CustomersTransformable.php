<?php

namespace App\BO\Customers\v100\Transformations;

use App\BO\Customers\v100\Models\Customers;

/**
 * Customers Transformable Trait.
 *
 * This trait provides a method to transform customer data into a consistent format.
 * It's used across various service classes or controllers to ensure that the customer
 * data structure is standardized throughout the application.
 *
 * @package App\BO\Customers\v100\Transformations
 */
trait CustomersTransformable
{
    /**
     * Transform a customer object into a standardized format.
     *
     * This method takes a Customers model instance and transforms it into
     * a new Customers object with a consistent structure, useful for API responses
     * or internal data handling.
     *
     * @param Customers $customer The customer model to transform.
     * @return Customers A new customer object with standardized structure.
     */
    public function transformCustomer($customer)
    {
        $obj = new Customers();

        $obj->id = $customer->id;
        $obj->f_name = $customer->first_name;
        $obj->l_name = $customer->last_name;
        $obj->email_address = $customer->email;
        $obj->phone_number = $customer->phone;
        $obj->addrs = $customer->address;
        $obj->created = $customer->created_at;
        $obj->updated = $customer->updated_at;

        return $obj;
    }
}
    