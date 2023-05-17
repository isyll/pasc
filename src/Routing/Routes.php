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

  public function includeClass(string $className)
  {
    $reflection = new \ReflectionClass($className);
    $namespace  = $reflection->getNamespaceName();

    eval("use $namespace\\$className;");
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

    $class  = ucfirst(explode('/', $uri)[1]) . 'Controller';
    $action = explode('/', $uri)[2];

    eval("use App\\Controller\\$class; (new $class())->$action();");
  }
}