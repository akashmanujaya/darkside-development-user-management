<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\BO\Customers\v100\Models\Customers;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Customer 1
        Customers::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+441234567890',
            'address' => '123 Main Street'
        ]);

        // Customer 2
        Customers::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
            'phone' => '+441234567891',
            'address' => '456 Elm Street'
        ]);
    }
}
