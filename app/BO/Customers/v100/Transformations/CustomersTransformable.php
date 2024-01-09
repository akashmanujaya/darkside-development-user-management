<?php

namespace App\BO\Customers\v100\Transformations;

use App\BO\Customers\v100\Models\Customers;

trait CustomersTransformable
{
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
    