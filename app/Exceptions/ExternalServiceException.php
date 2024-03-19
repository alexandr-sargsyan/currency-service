<?php

namespace App\Exceptions;

use Exception;

class ExternalServiceException extends Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct('Failed to fetch currency data from external service');
    }
}
