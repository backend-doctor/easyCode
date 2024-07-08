<?php

namespace App\Exceptions;
use Exception;

class InvalidMethodVerificationException extends Exception
{
    public function __construct($message) {
        parent::__construct($message);
    }
}
