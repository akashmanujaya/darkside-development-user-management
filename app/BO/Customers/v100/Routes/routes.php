<?php

use App\Http\Controllers\Customers\v100\CustomerController;

/**
 * Routes for Customer Management.
 *
 * These routes handle the API endpoints for managing customer data. They are prefixed with
 * 'customer-management' and make use of the CustomerController to handle requests.
 * The routes are dynamically namespaced to support versioning.
 *
 * @package Routes
 */
Route::prefix('customer-management')->namespace('Customers\\'.$version)->group(function(){
    Route::get('/api/customers', [CustomerController::class, 'index']);
    Route::post('/api/customer', [CustomerController::class, 'store']);
    Route::put('/api/customer/{id}', [CustomerController::class, 'update']);
});
