<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Routing\Routes;

$router = new Routes();
// $router->register(['/article/all', ['ArticleController', 'all']]);
// $router->execute();