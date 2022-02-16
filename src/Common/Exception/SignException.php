<?php

namespace Xamin123\LearnBlockchain\Common\Exception;

use Exception;

class SignException extends Exception
{
    public function __construct()
    {
        $errorMessage = openssl_error_string();
        if ($errorMessage === false) {
            $errorMessage = 'Unknown openssl error';
        }
        parent::__construct($errorMessage);
    }
}