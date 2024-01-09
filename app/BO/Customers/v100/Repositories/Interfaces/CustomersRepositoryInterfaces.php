<?php

namespace App\BO\Customers\v100\Repositories\Interfaces;

use App\BO\Customers\v100\Models\Customers;

/**
 * Interface for the Customers Repository.
 *
 * This interface defines the standard operations to be performed on the Customers model.
 * It provides methods for finding, listing, creating, and updating customer records.
 *
 * @package App\BO\Customers\v100\Repositories\Interfaces
 */
interface CustomersRepositoryInterfaces
{
    /**
     * Retrieve a customer by their ID.
     *
     * @param mixed $id The ID of the customer to find.
     * @return Customers The found customer model instance.
     */
    public function findCustomerById($id): Customers;

    /**
     * List all customers with optional pagination.
     *
     * @param bool $paginate Flag to determine if results should be paginated.
     * @param int $perPage Number of items per page if pagination is enabled.
     * @return mixed The list of customers or paginated results.
     */
    public function listCustomers($paginate = false, $perPage = 10);

    /**
     * Create a new customer record.
     *
     * @param array $request Data used to create the customer.
     * @return Customers The newly created customer model instance.
     */
    public function createCustomer($request): Customers;

    /**
     * Update an existing customer record.
     *
     * @param array $request Data used to update the customer.
     * @param int $id The ID of the customer to update.
     * @return Customers The updated customer model instance.
     */
    public function updateCustomer($request, int $id): Customers;

}