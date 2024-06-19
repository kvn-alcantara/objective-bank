<?php

declare(strict_types=1);

namespace App\Infra\Repository\Transaction;

interface TransactionRepositoryContract
{
    public function create(array $data): int;
}
