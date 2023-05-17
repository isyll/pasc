<?php

namespace App\Routing;

use App\Controller\ArticleController;

class Routes
{
    private array $path;

    public function __construct(array $route = [])
    {
        if (count($route))
            $this->register($route);
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

    public function add404($route)
    {
        $this->path['page404'] = $route;
    }

    public function execute()
    {
        [$method, $uri] = $this->resolve();

        if (isset($this->path[$uri])) {
            $class  = $this->path[$uri][0];
            $action = $this->path[$uri][1];

            eval("use App\\Controller\\$class; (new $class())->$action();");
        } else if (isset($this->path['page404'])) {
            $class  = $this->path['page404'][0];
            $action = $this->path['page404'][1];

            eval("use App\\Controller\\$class; (new $class())->$action();");
        }
    }
}