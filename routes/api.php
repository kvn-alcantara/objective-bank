<?php

declare(strict_types=1);

use App\Main\Factory\Application\Action\StoreAccountActionFactory;
use App\Main\Factory\Application\Action\ShowAccountActionFactory;
use Slim\App;

return function (App $app) {
    $app->post('/conta', StoreAccountActionFactory::class);
    $app->get('/conta/{numero}', ShowAccountActionFactory::class);
};
