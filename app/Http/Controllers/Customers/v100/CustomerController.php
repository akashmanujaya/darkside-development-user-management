<?php

namespace App\Http\Controllers\Customers\v100;

use App\Base\Controller\BaseController;
use App\BO\Customers\v100\Requests\CustomersCreationRequest;
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

    public function store(CustomersCreationRequest $request)
    {
        try {
            $newCustomer = $this->customersService->createCustomer($request->all());
            if(isset($newCustomer)){
                return $newCustomer;
            } else {
                return $this->errorResponse('Error creating customer');
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}