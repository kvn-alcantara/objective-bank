<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class DomainAccountDuplicatedException extends DomainException
{
    public function __construct(string $message = 'Account already exists.')
    {
        parent::__construct($message);
    }
}
