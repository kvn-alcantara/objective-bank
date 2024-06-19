<?php

declare(strict_types=1);

namespace App\Infra\Repository\Account;

interface AccountRepositoryContract
{
    public function create(array $data): int;
    public function findByNumber(string $number): ?array;
    public function updateBalance(int $id, float $balance): bool;
}
