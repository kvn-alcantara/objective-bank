<?php

declare(strict_types=1);

namespace App\Infra\Repository\Contracts;

interface TransactionRepositoryContract
{
    public function create(array $data): array;
}
