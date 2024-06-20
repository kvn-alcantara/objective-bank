<?php

declare(strict_types=1);

namespace App\Main\Factory\Application\Action;

use App\Application\Action\Account\ShowAccountAction;
use App\Main\Factory\Domain\UseCase\ShowAccountUseCaseFactory;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ShowAccountActionFactory
{
    public function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        $action = new ShowAccountAction($request, $response, $args, ShowAccountUseCaseFactory::make());
        return $action();
    }
}
