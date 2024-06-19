<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class DomainRecordDuplicatedException extends DomainException
{
    public function __construct(string $message = 'Already exists.')
    {
        parent::__construct($message);
    }
}
