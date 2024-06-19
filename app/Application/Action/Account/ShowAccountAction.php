<?php

declare(strict_types=1);

namespace App\Application\Action\Account;

use App\Application\Action\Action;
use App\Domain\UseCase\ShowAccountUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ShowAccountAction extends Action
{
    public function __construct(
        Request $request,
        Response $response,
        array $args,
        private ShowAccountUseCase $showAccountUseCase
    ) {
        parent::__construct($request, $response, $args);
    }

    protected function perform(): Response
    {
        $account = $this->showAccountUseCase->handle($this->resolveArg('numero'));

        return $this->respondWithData($account);
    }
}
