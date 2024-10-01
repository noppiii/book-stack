<?php

namespace App\Exceptions;

use Exception;

class UserTokenExpiredException extends Exception
{
    public function __construct(string $message, int $userId)
    {
        $this->userId = $userId;
        parent::__construct($message);
    }
}
