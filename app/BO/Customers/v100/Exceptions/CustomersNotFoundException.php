<?php

namespace App\BO\Customers\v100\Exceptions;

use App\Base\Exception\BaseException;

/**
 * Exception class for handling scenarios where customers are not found.
 *
 * This exception should be thrown when a customer query fails to find
 * any matching customer records in the database. It sets an HTTP status code
 * of 404 to indicate a 'Not Found' response and a custom code for internal tracking.
 *
 * @package App\BO\Customers\v100\Exceptions
 */
class CustomersNotFoundException extends BaseException
{
    /**
     * Constructs the CustomersNotFoundException.
     *
     * Initializes the HTTP status code to 404 (Not Found) and
     * sets a custom code specific to this exception.
     */
    public function __construct()
    {
        $this->http_status_code = 404;
        $this->code = 2006;
    }
}