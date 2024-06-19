<?php

declare(strict_types=1);

namespace App\Main\Factory\Domain\UseCase;

use App\Domain\UseCase\StoreAccountUseCase;
use App\Main\Factory\Infra\Repository\AccountRepositoryFactory;

class StoreAccountUseCaseFactory
{
    public static function make(): StoreAccountUseCase
    {
        return new StoreAccountUseCase((new AccountRepositoryFactory())->make());
    }
}
