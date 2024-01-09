<?php

namespace App\Http\Controllers\Customers\v100;

use App\Base\Controller\BaseController;
use App\BO\Customers\v100\Requests\CustomersCreationRequest;
use App\BO\Customers\v100\Requests\CustomersUpdateReqeust;
use App\BO\Customers\v100\Services\CustomersService;

/**
 * Customer Controller.
 *
 * This controller handles the HTTP requests related to customer operations.
 * It utilizes the CustomersService for business logic and processes incoming requests
 * such as listing, creating, and updating customer data.
 *
 * @package App\Http\Controllers\Customers\v100
 */
class CustomerController extends BaseController
{
    /**
     * Customers service instance.
     *
     * @var CustomersService
     */
    protected $customersService;

    /**
     * CustomerController constructor.
     *
     * @param CustomersService $customersService The Customers service instance.
     */
    public function __construct(CustomersService $customersService)
    {
        parent::__construct(new Module());
        $this->middleware('revalidate');
        $this->customersService = $customersService;
    }

    /**
     * Display a listing of customers.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created customer in storage.
     *
     * @param CustomersCreationRequest $request The request object containing customer data.
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified customer in storage.
     *
     * @param CustomersUpdateRequest $request The request object containing customer data.
     * @param int $id The ID of the customer to update.
     * @return \Illuminate\Http\Response
     */
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