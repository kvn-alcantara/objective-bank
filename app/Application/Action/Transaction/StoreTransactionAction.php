<?php

declare(strict_types=1);

namespace App\Application\Action\Transaction;

use App\Application\Action\Action;
use App\Domain\UseCase\StoreTransactionUseCase;
use App\Infra\Database\Database;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StoreTransactionAction extends Action
{
    public function __construct(
        Request $request,
        Response $response,
        array $args,
        private StoreTransactionUseCase $storeTransactionUseCase
    ) {
        parent::__construct($request, $response, $args);
    }

    protected function perform(): Response
    {
        $db = Database::getInstance();

        $db->beginTransaction();
        try {
            $account = $this->storeTransactionUseCase->handle($this->getFormData());
            $db->commit();
        } catch (\Throwable $t) {
            $db->rollBack();
            throw $t;
        }

        return $this->respondWithData($account, 201);
    }
}
