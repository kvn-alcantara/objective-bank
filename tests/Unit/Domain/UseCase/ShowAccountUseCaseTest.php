<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\UseCase;

use App\Domain\Exception\DomainRecordDuplicatedException;
use App\Domain\Exception\DomainRecordNotFoundException;
use App\Domain\UseCase\ShowAccountUseCase;
use App\Infra\Repository\Account\AccountRepositoryContract;
use PHPUnit\Framework\TestCase;

class ShowAccountUseCaseTest extends TestCase
{
    public function testShouldShowAccountSuccessfully()
    {
        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn([
            'number' => '123456',
            'balance' => 1000
        ]);

        $sut = new ShowAccountUseCase($accountRepoMock);

        $result = $sut->handle('123456');

        $this->assertEquals([
            'numero_conta' => '123456',
            'saldo' => 1000
        ], $result);
    }

    public function testShouldThrowExceptionWhenAccountDoesNotExists()
    {
        $this->expectException(DomainRecordNotFoundException::class);

        $accountRepoMock = $this->createMock(AccountRepositoryContract::class);

        $accountRepoMock->method('findByNumber')->willReturn(null);

        $sut = new ShowAccountUseCase($accountRepoMock);

        $sut->handle('123456');
    }
}
