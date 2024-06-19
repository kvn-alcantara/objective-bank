<?php

declare(strict_types=1);

namespace App\Domain\UseCase;

use App\Domain\Exception\DomainAccountDuplicatedException;
use App\Infra\Repository\Account\AccountRepositoryContract;

class StoreAccountUseCase
{
    public function __construct(private AccountRepositoryContract $accountRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function handle(array $data): array
    {
        $exists = $this->accountRepository->findByNumber((string)$data['numero_conta']);

        if ($exists) {
            throw new DomainAccountDuplicatedException();
        }

        $this->accountRepository->create($data);

        return [
            'numero_conta' => $data['numero_conta'],
            'saldo' => $data['saldo']
        ];
    }
}
