<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Exception\DomainNegativeBalanceException;
use App\Domain\Exception\DomainRecordNotFoundException;
use App\Infra\Repository\Account\AccountRepositoryContract;
use App\Infra\Repository\PaymentMethod\PaymentMethodRepositoryContract;
use App\Infra\Repository\Transaction\TransactionRepositoryContract;
use App\Main\Utils;

class StoreTransactionUseCase
{
    public function __construct(
        private AccountRepositoryContract $accountRepository,
        private TransactionRepositoryContract $transactionRepository,
        private PaymentMethodRepositoryContract $paymentMethodRepository
    ) {
    }

    /**
     * @throws \Exception
     */
    public function handle(array $data): array
    {
        $account = $this->accountRepository->findByNumber((string)$data['numero_conta']);

        if (!$account) {
            throw new DomainRecordNotFoundException();
        }

        $paymentMethod = $this->paymentMethodRepository->findByAcronym($data['forma_pagamento']);

        if (!$paymentMethod) {
            throw new DomainRecordNotFoundException();
        }

        $operation = array_map(fn($value) => Utils::dolarToCents((float)$value), [
            'balance' => $account['balance'],
            'amount' => $data['valor'],
            'tax' => $data['valor'] * $paymentMethod['tax']
        ]);

        $newBalance = Utils::centsToDolar($operation['balance'] - ($operation['amount'] + $operation['tax']));

        if ($newBalance < 0) {
            throw new DomainNegativeBalanceException();
        }

        $this->transactionRepository->create([
            'payment_method_acronym' => $paymentMethod['acronym'],
            'payment_method_tax' => $paymentMethod['tax'],
            'account_id' => $account['id'],
            'amount' => $data['valor'],
            'balance' => $newBalance
        ]);

        $this->accountRepository->updateBalance($account['id'], $newBalance);

        return [
            'numero_conta' => $account['number'],
            'saldo' => $newBalance
        ];
    }
}
