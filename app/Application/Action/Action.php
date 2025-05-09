<?php

declare(strict_types=1);

namespace App\Application\Action;

use App\Domain\Exception\DomainNegativeBalanceException;
use App\Domain\Exception\DomainRecordNotFoundException;
use App\Domain\Exception\DomainRecordDuplicatedException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;

abstract class Action
{
    /**
     * @throws HttpNotFoundException
     * @throws HttpBadRequestException
     */
    public function __construct(
        protected Request $request,
        protected Response $response,
        protected array $args
    ) {
    }

    public function __invoke(): Response
    {
        try {
            return $this->perform();
        } catch (DomainRecordNotFoundException | DomainNegativeBalanceException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        } catch (DomainRecordDuplicatedException $e) {
            throw new HttpBadRequestException($this->request, $e->getMessage());
        }
    }

    /**
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function perform(): Response;

    /**
     * @return array|object
     */
    protected function getFormData()
    {
        return $this->request->getParsedBody();
    }

    /**
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name)
    {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    /**
     * @param array|object|null $data
     */
    protected function respondWithData($data = null, int $statusCode = 200): Response
    {
        $payload = new ActionPayload($statusCode, $data);

        return $this->respond($payload);
    }

    protected function respond(ActionPayload $payload): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus($payload->getStatusCode());
    }
}
