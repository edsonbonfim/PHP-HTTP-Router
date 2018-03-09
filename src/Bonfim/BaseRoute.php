<?php

namespace Bonfim\Component\Routing;

class BaseRoute
{
    private $name;
    private $path;
    private $verb;
    private $controller;
    private $action;
    private $args = [];

    public function __construct(array $route)
    {
        foreach ($route as $key => $value) {
            $this->$key = $value;
        }
    }

    public function getArgs(?string $key = null)
    {
        if (!is_null($key)) {
            return $this->args[$key];
        }

        return $this->args;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function setArgs(string $key, string $value): void
    {
        $this->args[$key] = $value;
    }

    public function __call(string $function, array $args)
    {
        $key = strtolower(substr($function, 3, strlen($function)));
        return $this->$key;
    }
}
