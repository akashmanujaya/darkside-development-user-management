<?php

namespace App\BO\Customers\v100\Repositories\Interfaces;

use App\BO\Customers\v100\Models\Customers;

interface CustomersRepositoryInterfaces
{
    public function findCustomerById($id): Customers;
}