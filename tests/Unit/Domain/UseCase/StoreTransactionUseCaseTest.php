<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\UseCase;

use App\Domain\Exception\DomainNegativeBalanceException;
use App\Domain\Exception\DomainRecordNotFoundException;
use App\Domain\UseCase\StoreTransactionUseCase;
use App\Infra\Repository\Account\AccountRepositoryContract;
use App\Infra\Repository\PaymentMethod\PaymentMethodRepositoryContract;
use App\Infra\Repository\Transaction\TransactionRepositoryContract;
use PHPUnit\Framework\TestCase;

class StoreTransactionUseCaseTest extends TestCase
{
    public function testShouldStoreTransactionSuccessfully()
    {
        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);
        $transactionRepoMock = $this->createMock(TransactionRepositoryContract::class);
        $paymentRepoMock = $this->createMock(PaymentMethodRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn([
            'id' => 1,
            'number' => '234',
            'balance' => 180.37
        ]);

        $paymentRepoMock->method('findByAcronym')->willReturn([
            'acronym' => 'D',
            'tax' => 0.03
        ]);

        $transactionRepoMock->method('create')->willReturn(1);

        $accountRepoMock->method('updateBalance')->willReturn(true);

        $sut = new StoreTransactionUseCase($accountRepoMock, $transactionRepoMock, $paymentRepoMock);

        $result = $sut->handle([
            'numero_conta' => '234',
            'forma_pagamento' => 'D',
            'valor' => 10
        ]);

        $this->assertEquals([
            'numero_conta' => '234',
            'saldo' => 170.07,
        ], $result);
    }

    public function testShouldThrowExceptionWhenAccountDoesNotExists()
    {
        $this->expectException(DomainRecordNotFoundException::class);

        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);
        $transactionRepoMock = $this->createMock(TransactionRepositoryContract::class);
        $paymentRepoMock = $this->createMock(PaymentMethodRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn(null);

        $sut = new StoreTransactionUseCase($accountRepoMock, $transactionRepoMock, $paymentRepoMock);

        $sut->handle([
            'numero_conta' => '234',
            'forma_pagamento' => 'D',
            'valor' => 10
        ]);
    }

    public function testShouldThrowExceptionWhenPaymentMethodDoesNotExists()
    {
        $this->expectException(DomainRecordNotFoundException::class);

        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);
        $transactionRepoMock = $this->createMock(TransactionRepositoryContract::class);
        $paymentRepoMock = $this->createMock(PaymentMethodRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn([
            'id' => 1,
            'number' => '234',
            'balance' => 180.37
        ]);

        $paymentRepoMock->method('findByAcronym')->willReturn(null);

        $sut = new StoreTransactionUseCase($accountRepoMock, $transactionRepoMock, $paymentRepoMock);

        $sut->handle([
            'numero_conta' => '234',
            'forma_pagamento' => 'D',
            'valor' => 10
        ]);
    }

    public function testShouldThrowExceptionWhenBalanceIsNegative()
    {
        $this->expectException(DomainNegativeBalanceException::class);

        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);
        $transactionRepoMock = $this->createMock(TransactionRepositoryContract::class);
        $paymentRepoMock = $this->createMock(PaymentMethodRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn([
            'id' => 1,
            'number' => '234',
            'balance' => 180.37
        ]);

        $paymentRepoMock->method('findByAcronym')->willReturn([
            'acronym' => 'D',
            'tax' => 0.03
        ]);

        $sut = new StoreTransactionUseCase($accountRepoMock, $transactionRepoMock, $paymentRepoMock);

        $sut->handle([
            'numero_conta' => '234',
            'forma_pagamento' => 'D',
            'valor' => 200
        ]);
    }
}
