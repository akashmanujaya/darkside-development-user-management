<?php

namespace App\BO\Customers\v100\Services;

use App\Base\Exception\BaseException;
use App\Base\Services\BaseService;
use App\BO\Customers\v100\Repositories\CustomersRepository;
use App\BO\Customers\v100\Transformations\CustomersTransformable;

class CustomersService extends BaseService
{
    use CustomersTransformable;

    protected $customersRepo;

    public function __construct(CustomersRepository $customersRepo)
    {
        parent::__construct();
        $this->customersRepo = $customersRepo;
    }

    public function findCustomerById($id)
    {
        try {
            $customer = $this->customersRepo->findCustomerById($id);
            return $this->transformCustomer($customer);
        } catch (\Exception $e) {
            throw $e;
        }
    }

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
}