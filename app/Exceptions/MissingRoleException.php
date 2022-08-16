<?php

namespace App\Exceptions;

use Exception;

class MissingRoleException extends Exception
{
    private array $roles;

    public function __construct(array $roles = [], $message = 'Invalid role provided')
    {
        parent::__construct($message);

        $this->roles = $roles;
    }

    public function roles(): array
    {
        return $this->roles;
    }
}
