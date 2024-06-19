<?php

declare(strict_types=1);

namespace App\Infra\Repository\PaymentMethod;

interface PaymentMethodRepositoryContract
{
    public function findByAcronym(string $acronym): ?array;
}
