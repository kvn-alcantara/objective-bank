<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Exception\DomainRecordNotFoundException;
use App\Infra\Repository\Account\AccountRepositoryContract;

class ShowAccountUseCase
{
    public function __construct(private AccountRepositoryContract $accountRepository)
    {
    }

    /**
     * @throws DomainException
     */
    public function handle(string $number): array
    {
        $account = $this->accountRepository->findByNumber($number);

        if (!$account) {
            throw new DomainRecordNotFoundException();
        }

        return [
            'numero_conta' => (int)$account['number'],
            'saldo' => (float)$account['balance']
        ];
    }
}
