<?php

declare(strict_types=1);

namespace App\Main\Factory\Infra\Repository;

use App\Infra\Database\Database;
use App\Infra\Repository\PaymentMethod\PaymentMethodRepositoryContract;
use App\Infra\Repository\PaymentMethod\PdoPaymentMethodRepository;

class PaymentMethodRepositoryFactory
{
    public static function make(): PaymentMethodRepositoryContract
    {
        return new PdoPaymentMethodRepository(Database::getInstance());
    }
}
