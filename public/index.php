<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Routing\Routes;

$router = new Routes();
$router->register(['/article/all', ['ArticleController', 'all']]);
$router->register(['/view/article/all', ['ViewController', 'allArticles']]);
$router->register(['/view/article/insert', ['ViewController', 'insertArticles']]);
$router->execute();
