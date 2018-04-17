<?php

namespace Router;

/**
 * Class Route
 * @package Router
 */
class Route
{
    /**
     * @var BaseRouter
     */
    private $router;

    /**
     * @var
     */
    private static $route;
    /**
     * @var null
     */
    private static $match = null;

    /**
     * Route constructor.
     */
    private function __construct()
    {
        $this->router = new BaseRouter();
    }

    /**
     * @return Route
     */
    private static function route(): Route
    {
        if (!isset(self::$route) || is_null(self::$route)) {
            self::$route = new Route;
        }

        return self::$route;
    }

    /**
     * @return null|BaseRoute
     */
    private static function match(): ?BaseRoute
    {
        if (!isset(self::$match) || is_null(self::$match)) {
            self::$match = self::route()->router->handle();
        }

        return self::$match;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param $callback
     * @return void
     */
    private function handle(string $method, string $uri, $callback): void
    {
        $this->router->add([
            'uri' => $uri,
            'name' => '',
            'method' => $method,
            'callback' => $callback
        ]);

        $match = $this->match();

        call_user_func_array($match->getCallback(), $match->getArgs());

        exit;
    }

    /**
     * @param string $uri
     * @param $callback
     */
    public static function get(string $uri, $callback): void
    {
        self::route()->handle('get', $uri, $callback);
    }

    /**
     * @param string $uri
     * @param $callback
     */
    public static function post(string $uri, $callback): void
    {
        self::route()->handle('post', $uri, $callback);
    }

    /**
     * @param string $uri
     * @param $callback
     */
    public static function put(string $uri, $callback): void
    {
        self::route()->handle('put', $uri, $callback);
    }

    /**
     * @param string $uri
     * @param $callback
     */
    public static function patch(string $uri, $callback): void
    {
        self::route()->handle('patch', $uri, $callback);
    }

    /**
     * @param string $uri
     * @param $callback
     */
    public static function delete(string $uri, $callback): void
    {
        self::route()->handle('delete', $uri, $callback);
    }

    /**
     * @param string $uri
     * @param $callback
     */
    public static function options(string $uri, $callback): void
    {
        self::route()->handle('options', $uri, $callback);
    }
}
