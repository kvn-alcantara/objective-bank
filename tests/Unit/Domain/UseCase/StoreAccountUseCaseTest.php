<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\UseCase;

use App\Domain\Exception\DomainRecordDuplicatedException;
use App\Domain\UseCase\StoreAccountUseCase;
use App\Infra\Repository\Account\AccountRepositoryContract;
use PHPUnit\Framework\TestCase;

class StoreAccountUseCaseTest extends TestCase
{
    public function testShouldStoreAccountSuccessfully()
    {
        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn(null);

        $useCase = new StoreAccountUseCase($accountRepoMock);

        $data = [
            'numero_conta' => '123456',
            'saldo' => 1000
        ];

        $result = $useCase->handle($data);

        $this->assertEquals($data, $result);
    }

    public function testShouldThrowExceptionWhenAccountAlreadyExists()
    {
        $this->expectException(DomainRecordDuplicatedException::class);

        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn([
            'numero_conta' => '123456',
            'saldo' => 1000
        ]);

        $useCase = new StoreAccountUseCase($accountRepoMock);

        $data = [
            'numero_conta' => '123456',
            'saldo' => 1000
        ];

        $useCase->handle($data);
    }
}
