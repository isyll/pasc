<?php

namespace App\Routing;

use App\Controller\ArticleController;

class Routes
{
  private array $path;

  public function __construct()
  {
    $this->execute();
  }

  public function register(array $route)
  {
    $this->path[$route[0]] = $route[1];
  }

  public function resolve()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri    = $_SERVER['REQUEST_URI'];

    if (false !== $pos = strpos($uri, '?')) {
      $uri = substr($uri, 0, $pos);
    }

    return [$method, $uri];
  }

  public function execute()
  {
    [$method, $uri] = $this->resolve();

    switch ($uri) {
      case '/article/all':
        $arc = new ArticleController();
        $arc->all();
        break;
      case '/article/ajouter':
        if ($method == 'POST') {
          $arc = new ArticleController();
          echo $arc->insert();
        }
        break;
    }

  }
}