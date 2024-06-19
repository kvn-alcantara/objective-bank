<?php

declare(strict_types=1);

namespace App\Main\Factory\Domain\UseCase;

use App\Domain\UseCase\StoreTransactionUseCase;
use App\Main\Factory\Infra\Repository\AccountRepositoryFactory;
use App\Main\Factory\Infra\Repository\PaymentMethodRepositoryFactory;
use App\Main\Factory\Infra\Repository\TransactionRepositoryFactory;

class StoreTransactionUseCaseFactory
{
    public static function make(): StoreTransactionUseCase
    {
        return new StoreTransactionUseCase(
            (new AccountRepositoryFactory())->make(),
            (new TransactionRepositoryFactory())->make(),
            (new PaymentMethodRepositoryFactory())->make()
        );
    }
}
