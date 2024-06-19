<?php

declare(strict_types=1);

namespace App\Main\Factory\Application\Action;

use App\Application\Action\Account\StoreAccountAction;
use App\Main\Factory\Domain\UseCase\StoreAccountUseCaseFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class StoreAccountActionFactory
{
    public function __invoke(Request $request, Response $response, array $args)
    {
        $action = new StoreAccountAction($request, $response, $args, (new StoreAccountUseCaseFactory())->make());
        return $action();
    }
}
