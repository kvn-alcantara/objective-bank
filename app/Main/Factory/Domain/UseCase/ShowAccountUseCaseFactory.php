<?php

declare(strict_types=1);

namespace App\Main\Factory\Domain\UseCase;

use App\Domain\UseCase\ShowAccountUseCase;
use App\Main\Factory\Infra\Repository\AccountRepositoryFactory;

class ShowAccountUseCaseFactory
{
    public static function make(): ShowAccountUseCase
    {
        return new ShowAccountUseCase((new AccountRepositoryFactory())->make());
    }
}
