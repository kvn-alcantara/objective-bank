<?php

declare(strict_types=1);

namespace App\Main\Factory\Infra\Repository;

use App\Infra\Database\Database;
use App\Infra\Repository\Account\AccountRepositoryContract;
use App\Infra\Repository\Account\PdoAccountRepository;

class AccountRepositoryFactory
{
    public static function make(): AccountRepositoryContract
    {
        return new PdoAccountRepository(Database::getInstance());
    }
}
