<?php

declare(strict_types=1);

use App\Main\Factory\Application\Action\StoreAccountActionFactory;
use App\Main\Factory\Application\Action\ShowAccountActionFactory;
use App\Main\Factory\Application\Action\StoreTransactionActionFactory;
use Slim\App;

return static function (App $app) {
    $app->post('/conta', StoreAccountActionFactory::class);
    $app->get('/conta/{numero}', ShowAccountActionFactory::class);
    $app->post('/transacao', StoreTransactionActionFactory::class);
};
