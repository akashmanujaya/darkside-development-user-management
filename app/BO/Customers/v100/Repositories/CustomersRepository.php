<?php

namespace App\BO\Customers\v100\Repositories;

use App\BO\Customers\v100\Exceptions\CustomersNotFoundException;
use App\BO\Customers\v100\Models\Customers;
use App\BO\Customers\v100\Repositories\Interfaces\CustomersRepositoryInterfaces;

/**
 * Customers Repository.
 *
 * Implements the operations defined in the CustomersRepositoryInterfaces.
 * This class provides functionality for finding, listing, creating, and updating
 * customer records using the Customers model.
 *
 * @package App\BO\Customers\v100\Repositories
 */
class CustomersRepository implements CustomersRepositoryInterfaces
{
    /**
     * Customers model instance.
     *
     * @var Customers
     */
    protected $model;

    /**
     * CustomersRepository constructor.
     *
     * @param Customers $customers The Customers model instance.
     */
    public function __construct(Customers $customers)
    {
        $this->model = $customers;
    }

    /**
     * Find a customer by their ID.
     *
     * @param mixed $id The ID of the customer to find.
     * @return Customers The found customer model instance.
     * @throws CustomersNotFoundException if no customer is found.
     */
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

    /**
     * List all customers.
     *
     * @param bool $paginate Flag to determine if results should be paginated.
     * @param int $page The page number for paginated results.
     * @param int $limit Number of items per page if pagination is enabled.
     * @return mixed The list of customers or paginated results.
     */
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

    /**
     * Create a new customer record.
     *
     * @param array $request Data used to create the customer.
     * @return Customers The newly created customer model instance.
     */
    public function createCustomer ($request): Customers
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

    /**
     * Update an existing customer record.
     *
     * @param array $request Data used to update the customer.
     * @param int $id The ID of the customer to update.
     * @return Customers The updated customer model instance.
     */
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

    /**
     * Sanitize the input data.
     *
     * @param array $input The input data to sanitize.
     * @return array The sanitized data.
     */
    private function sanitizeInput(array $input) {
        $sanitized = [];
        foreach ($input as $key => $value) {
            // Sanitize if the value is a string, leave it unchanged otherwise
            $sanitized[$key] = is_string($value) ? htmlspecialchars($value, ENT_QUOTES, 'UTF-8') : $value;
        }
        return $sanitized;
    }
}