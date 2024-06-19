<?php

declare(strict_types=1);

use App\Main\Factory\Application\Action\StoreAccountActionFactory;
use Slim\App;

return function (App $app) {
    $app->post('/conta', StoreAccountActionFactory::class);
};
