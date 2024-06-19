<?php

declare(strict_types=1);

namespace App\Application\Action\Account;

use App\Application\Action\Action;
use App\Domain\UseCase\StoreAccountUseCase;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StoreAccountAction extends Action
{
    public function __construct(
        Request $request,
        Response $response,
        array $args,
        private StoreAccountUseCase $storeAccountUseCase
    ) {
        parent::__construct($request, $response, $args);
    }

    protected function perform(): Response
    {
        $account = $this->storeAccountUseCase->handle($this->getFormData());

        return $this->respondWithData($account, 201);
    }
}
