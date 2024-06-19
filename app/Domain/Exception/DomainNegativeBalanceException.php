<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class DomainNegativeBalanceException extends DomainException
{
    public function __construct(string $message = 'Not enough balance.')
    {
        parent::__construct($message);
    }
}
