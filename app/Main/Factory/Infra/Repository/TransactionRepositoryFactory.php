<?php

declare(strict_types=1);

namespace App\Main\Factory\Infra\Repository;

use App\Infra\Database\Database;
use App\Infra\Repository\Transaction\TransactionRepositoryContract;
use App\Infra\Repository\Transaction\PdoTransactionRepository;

class TransactionRepositoryFactory
{
    public static function make(): TransactionRepositoryContract
    {
        return new PdoTransactionRepository(Database::getInstance());
    }
}
