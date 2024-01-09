<?php

namespace App\BO\Customers\v100\Services;

use App\Base\Exception\BaseException;
use App\Base\Services\BaseService;
use App\BO\Customers\v100\Models\Customers;
use App\BO\Customers\v100\Repositories\CustomersRepository;
use App\BO\Customers\v100\Transformations\CustomersTransformable;

/**
 * Service class for Customer operations.
 *
 * This service class handles the business logic associated with customer data.
 * It communicates with the CustomersRepository to access and manipulate customer data.
 * Additionally, it uses the CustomersTransformable trait to transform customer data.
 *
 * @package App\BO\Customers\v100\Services
 */
class CustomersService extends BaseService
{
    use CustomersTransformable;

    /**
     * Customers repository instance.
     *
     * @var CustomersRepository
     */
    protected $customersRepo;

    /**
     * CustomersService constructor.
     *
     * @param CustomersRepository $customersRepo The Customers repository instance.
     */
    public function __construct(CustomersRepository $customersRepo)
    {
        parent::__construct();
        $this->customersRepo = $customersRepo;
    }

    /**
     * Find a customer by their ID and return the transformed data.
     *
     * @param mixed $id The ID of the customer to find.
     * @return array The transformed customer data.
     * @throws \Exception If any error occurs during the operation.
     */
    public function findCustomerById($id)
    {
        try {
            $customer = $this->customersRepo->findCustomerById($id);
            return $this->transformCustomer($customer);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * List all customers and return their transformed data.
     *
     * @return array The list of transformed customer data.
     * @throws \Exception If any error occurs during the operation.
     */
    public function listCustomers()
    {
        try {
            $customers = $this->customersRepo->listCustomers($paginate = true);
            foreach ($customers as $key=>$customer) {
                $customers[$key] = $this->transformCustomer($customer);
            }

            return $customers;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Create a new customer using the provided data and return the transformed customer.
     *
     * @param array $request The data used to create a new customer.
     * @return array The transformed data of the newly created customer.
     * @throws BaseException|Exception If any error occurs during the operation.
     */
    public function createCustomer($request)
    {
        try {
            $customer = $this->customersRepo->createCustomer($request);
            return $this->transformCustomer($customer);
        } catch (BaseException $e) {
            throw $e;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Update an existing customer with the provided data and return the transformed customer.
     *
     * @param array $request The data used to update the customer.
     * @param int $id The ID of the customer to update.
     * @return array The transformed data of the updated customer.
     * @throws BaseException|Exception If any error occurs during the operation.
     */
    public function updateCustomer($request, int $id): Customers
    {
        try {
            $customer = $this->customersRepo->updateCustomer($request, (int)$id);
            return $this->transformCustomer($customer);
        } catch (BaseException $e) {
            throw $e;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}