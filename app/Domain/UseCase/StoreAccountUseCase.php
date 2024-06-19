<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Exception\DomainRecordDuplicatedException;
use App\Infra\Repository\Account\AccountRepositoryContract;

class StoreAccountUseCase
{
    public function __construct(private AccountRepositoryContract $accountRepository)
    {
    }

    /**
     * @throws DomainException
     */
    public function handle(array $data): array
    {
        $exists = $this->accountRepository->findByNumber((string)$data['numero_conta']);

        if ($exists) {
            throw new DomainRecordDuplicatedException();
        }

        $this->accountRepository->create($data);

        return [
            'numero_conta' => $data['numero_conta'],
            'saldo' => $data['saldo']
        ];
    }
}
