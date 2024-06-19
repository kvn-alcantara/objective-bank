<?php

declare(strict_types=1);

namespace App\Domain\Exception;

class DomainRecordNotFoundException extends DomainException
{
    public function __construct(string $message = 'Record not found.')
    {
        parent::__construct($message);
    }
}
