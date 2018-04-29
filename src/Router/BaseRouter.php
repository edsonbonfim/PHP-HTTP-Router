<?php

namespace Router;

class BaseRouter
{
    private $path;
    private $verb;
    private static $routes = [];

    public function __construct()
    {
        $this->verb = strtolower($_SERVER['REQUEST_METHOD']);
        $this->path = $this->parseBrowserPath($_SERVER['REQUEST_URI']);
        if (count($this->path) == 0) {
            $this->path[] = 'index';
        }
    }

    public function add(array $route): void
    {
        if ($route['uri'] == '/') {
            $route['uri'] = '/index';
        }

        self::$routes[] = new BaseRoute($route);
    }

    public function handle(): ?BaseRoute
    {
        foreach (self::$routes as $route) {
            if ($this->checkVerb($route) && $this->checkPath($route)) {
                return $route;
            }
        }
        return null;
    }

    private function checkVerb(BaseRoute $route): bool
    {
        if ($this->verb != $route->getMethod()) {
            return false;
        }

        return true;
    }

    private function checkPath(BaseRoute $route): bool
    {
        if (!$this->parsePath($route)) {
            return false;
        }

        $routePath = $this->parseBrowserPath($route->getUri());

        if (count($routePath) != count($this->path)) {
            return false;
        }

        for ($i = 0; $i < count($routePath) && count($this->path); $i++) {
            if ($routePath[$i] != $this->path[$i]) {
                return false;
            }
        }

        return true;
    }

    private function parseBrowserPath(string $path): array
    {
        $path = explode('/', $path);
        $path = array_filter($path);
        $path = array_values($path);

        return $path;
    }

    private function parsePath(BaseRoute $route): bool
    {
        $path = $this->path;
        $routePath = $this->parseBrowserPath($route->getUri());

        for ($i = 0; $i < count($routePath) && $i < count($path); $i++) {
            $path[$i] = preg_replace('/\@.*/', $this->path[$i], $routePath[$i]);
            if ($path[$i] != $routePath[$i]) {
                // Regular expression matching
                if (preg_match('/\@([\w]+):(.*)/', $routePath[$i], $match)) {
                    if (preg_match('/'.$match[2].'/', $path[$i], $match[2])) {
                        if ($path[$i] != $match[2][0]) {
                            return false;
                        }
                        $route->setArg($match[1], $match[2][0]);
                    } else {
                        return false;
                    }
                } else {
                    $route->setArg(str_replace(':', '', $routePath[$i]), $path[$i]);
                }
            }
        }

        foreach ($_POST as $key => $value) {
            $route->setArg($key, $value);
        }
            
        $path = implode('/', $path);
        $route->setUri($path);

        return true;
    }

    public function getById($id): ?BaseRoute
    {
        return $this->routes[$id] ?? null;
    }

    public function getByName($name): ?BaseRoute
    {
        foreach (self::$routes as $route) {
            if ($route->getName() == $name) {
                return $route;
            }
        }

        return null;
    }
}
