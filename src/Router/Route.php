<?php

namespace Router;

use Exception;

class Route
{
    private static $route;
    private $router;

    private $controller;
    private $action;
    private static $match = null;

    private function __construct()
    {
        $this->router = new BaseRouter();
    }

    private static function route(): Route
    {
        if (!isset(self::$route) || is_null(self::$route)) {
            self::$route = new Route;
        }

        return self::$route;
    }

    public function call(string $verb, string $path, string $actionController): Route
    {
        $this->parseControllerAction([$path, $actionController]);

        $this->router->add([
            'verb'       => $verb,
            'path'       => $path,
            'controller' => $this->controller,
            'action'     => $this->action
        ]);

        return $this;
    }

    private function parseControllerAction($args): void
    {
        if (!preg_match('/([\w]+)::([\w]+)/is', $args[1], $callback)) {
            $message = "Invalid callback('{$args[1]}') to '{$args[0]}' route. Try: callback('Controller::action)'";
            throw new Exception($message);
        }

        $this->controller = $callback[1];
        $this->action     = $callback[2];
    }

    public static function match(): ?BaseRoute
    {
        if (!isset(self::$match) || is_null(self::$match)) {
            self::$match = self::route()->router->handle();
        }

        return self::$match;
    }

    public static function __callStatic(string $function, array $args): Route
    {
        return call_user_func_array([self::route(), 'call'], array_merge([$function], $args));
    }
}
