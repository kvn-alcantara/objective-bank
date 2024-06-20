<?php

declare(strict_types=1);

namespace App\Main\Factory\Application\Action;

use App\Application\Action\Transaction\StoreTransactionAction;
use App\Main\Factory\Domain\UseCase\StoreTransactionUseCaseFactory;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class StoreTransactionActionFactory
{
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        $action = new StoreTransactionAction(
            $request,
            $response,
            $args,
            StoreTransactionUseCaseFactory::make()
        );
        return $action();
    }
}
