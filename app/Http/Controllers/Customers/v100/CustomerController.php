<?php

namespace App\Http\Controllers\Customers\v100;

use App\Base\Controller\BaseController;
use App\BO\Customers\v100\Requests\CustomersCreationRequest;
use App\BO\Customers\v100\Requests\CustomersUpdateReqeust;
use App\BO\Customers\v100\Services\CustomersService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    protected $customersService;

    public function __construct(CustomersService $customersService)
    {
        parent::__construct(new Module());
        $this->middleware('revalidate');
        $this->customersService = $customersService;
    }

    public function index()
    {
        try {
            $customers = $this->customersService->listCustomers();

            if(isset($customers)){
                return $customers;
            } else {
                return $this->errorResponse('Error retrieving customers');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(CustomersCreationRequest $request)
    {
        try {
            $newCustomer = $this->customersService->createCustomer($request);
            if(isset($newCustomer)){
                return $newCustomer;
            } else {
                return $this->errorResponse('Error creating customer');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(CustomersUpdateReqeust $request, int $id)
    {
        try {
            $customer = $this->customersService->updateCustomer($request, $id);
            if(isset($customer)){
                return $customer;
            } else {
                return $this->errorResponse('Error creating customer');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}