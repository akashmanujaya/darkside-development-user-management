<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\BO\Customers\v100\Services\CustomersService;

class CustomerControllerTest extends TestCase
{
    use WithoutMiddleware; // Skip middleware for testing

    protected $mockService;

    public function setUp(): void
    {
        parent::setUp();
        // Mock the CustomersService and bind it in the IoC container
        $this->mockService = $this->createMock(CustomersService::class);
        $this->app->instance(CustomersService::class, $this->mockService);
    }

    public function testIndexReturnsData()
    {
        $mockedCustomerData = [
            ['id' => 1, 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@example.com', 'phone' => '+441234567890', 'address' => '123 Main Street'],
            // Add more customer data as needed for your test
        ];
        $this->mockService->method('listCustomers')->willReturn($mockedCustomerData);

        $response = $this->get('/admin/customer-management/api/customers');

        $response->assertStatus(200)
                 ->assertJson($mockedCustomerData);
    }

    public function testStoreCreatesNewCustomer()
    {
        $customerData = [
            'first_name' => 'Alice',
            'last_name' => 'Smith',
            'email' => 'alice@example.com',
            'phone' => '+441234567891',
            'address' => '456 Elm Street'
        ];
        $this->mockService->method('createCustomer')->willReturn(['message' => 'Customer created']);

        $response = $this->post('/admin/customer-management/api/customer', $customerData);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Customer created']);
    }

    public function testUpdateModifiesCustomer()
    {
        $customerData = [
            'first_name' => 'Bob',
            'last_name' => 'Brown',
            'email' => 'bob@example.com',
            'phone' => '+441234567892',
            'address' => '789 Oak Street'
        ];
        $customerId = 1; // Example customer ID
    
        // Create a mock customer object to return
        $mockCustomer = new \App\BO\Customers\v100\Models\Customers();
        $mockCustomer->id = $customerId;
        $mockCustomer->first_name = 'Bob';
        $mockCustomer->last_name = 'Brown';
        $mockCustomer->email = 'bob@example.com';
        $mockCustomer->phone = '+441234567892';
        $mockCustomer->address = '789 Oak Street';
    
        $this->mockService->method('updateCustomer')->willReturn($mockCustomer);
    
        $response = $this->put("/admin/customer-management/api/customer/{$customerId}", $customerData);
    
        $response->assertStatus(200);
    }
}
