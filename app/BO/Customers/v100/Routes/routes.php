<?php

use App\Http\Controllers\Customers\v100\CustomerController;

Route::prefix('customer-management')->namespace('Customers\\'.$version)->group(function(){
    Route::get('/api/customers', [CustomerController::class, 'index']);
    Route::post('/api/customer', [CustomerController::class, 'store']);
    Route::put('/api/cutomer/{id}', [CustomerController::class, 'update']);
    Route::delete('/api/customer/{id}', [CustomerController::class, 'destroy']);
});
