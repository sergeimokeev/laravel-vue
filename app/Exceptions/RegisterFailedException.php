<?php

namespace App\Exceptions;

use Exception;

class RegisterFailedException extends Exception
{
    public $message = 'Register error.';
}
