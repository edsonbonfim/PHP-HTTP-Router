<?php

namespace Router;

/**
 * Class Route
 * @package Router
 */
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
     * @var bool
     */
    private $status = false;

    /**
     * @var
     */
    private static $route;

    /**
     * @var null
     */
    private static $match = null;

    /**
     * @var null
     */
    private static $defaultCallback = null;

    /**
     * Route constructor.
     */
    private function __construct()
    {
        $this->router = new BaseRouter();
    }

    /**
     * Route destructor.
     */
    public function __destruct()
    {
        if (!$this->status) {
            $callback = self::$defaultCallback;
            if (is_callable($callback)) {
                $callback();
            }
        }

        exit;
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
    private static function dispatch(): ?BaseRoute
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

        $match = $this->dispatch();

        if ($match) {
            call_user_func_array($match->getCallback(), $match->getArgs());
            $this->status = true;
            exit;
        }
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

    /**
     * @param string $uri
     * @param $callback
     */
    public static function any(string $uri, $callback): void
    {
        $methods = ['get', 'post', 'put', 'patch', 'delete', 'options'];
        self::match($methods, $uri, $callback);
    }

    /**
     * @param array $methods
     * @param string $uri
     * @param $callback
     */
    public static function match(array $methods, string $uri, $callback): void
    {
        foreach ($methods as $method) {
            self::route()->handle($method, $uri, $callback);
        }
    }

    /**
     * @param $callback
     */
    public static function default($callback): void
    {
        self::$defaultCallback = $callback;
    }
}
