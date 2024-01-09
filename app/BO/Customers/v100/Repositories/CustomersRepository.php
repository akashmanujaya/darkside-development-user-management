<?php

namespace App\BO\Customers\v100\Repositories;

use App\BO\Customers\v100\Exceptions\CustomersNotFoundException;
use App\BO\Customers\v100\Models\Customers;
use App\BO\Customers\v100\Repositories\Interfaces\CustomersRepositoryInterfaces;

class CustomersRepository implements CustomersRepositoryInterfaces
{
    protected $model;

    public function __construct(Customers $customers)
    {
        $this->model = $customers;
    }

    public function findCustomerById($id): Customers
    {
        try {
            $customer = $this->model->find($id);

            if ($customer != null ) {
                return $customer;
            } else {
                throw new CustomersNotFoundException();
            }
        } catch (\Exception $e) {
            throw new CustomersNotFoundException();
        }
    }

    public function listCustomers($paginate = true, $page = 1, $limit = 10)
    {
        try {
            if ($paginate) {
                return $this->model->orderBy('created_at', 'DESC')->paginate($limit);
            } else {
                return $this->model->orderBy('created_at', 'DESC')->get();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function createCustomer ($request) 
    {
        
        try {
            // Sanitize the request data
            $sanitizedRequest = $this->sanitizeInput($request->all());

            // Create customer with sanitized data
            $customer = $this->model->create($sanitizedRequest);

            return $this->findCustomerById($customer->id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateCustomer($request, int $id): Customers
    {
        try {
            $customer = $this->findCustomerById($id);

            $sanitizedRequest = $this->sanitizeInput($request->all());

            $customer->update($sanitizedRequest);

            return $this->findCustomerById($customer->id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function sanitizeInput($input) {
        $sanitized = [];
        foreach ($input as $key => $value) {
            // Sanitize if the value is a string, leave it unchanged otherwise
            $sanitized[$key] = is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
        }
        return $sanitized;
    }
}