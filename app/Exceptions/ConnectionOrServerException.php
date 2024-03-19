<?php

namespace App\Exceptions;

use Exception;

class ConnectionOrServerException extends Exception
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}