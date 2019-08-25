<?php

namespace Bonfim\Router;

use ReflectionException;
use ReflectionFunction;

/**
 * Class Route
 * @package Router
 */
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
     * @var Router
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
     * Route constructor.
     */
    private function __construct()
    {
        $this->router = new Router();
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
     * @return null|Client
     */
    private static function dispatch(): ?Client
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
     * @throws ReflectionException
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

        $args = [];

        if ($match) {

            if (is_array($callback)) {
                $reflect = new \ReflectionMethod($callback[0], $callback[1]);
            } else {
                $reflect = new ReflectionFunction();
            }

            foreach ($reflect->getParameters() as $i => $param) {
                // Caso o parametro seja tipado
                if ($param->hasType()) {
                    // Adiciona o objecto Request nos parametros da classe
                    if ($param->getType()->getName() == Request::class) {
                        $args[$i] = new Request();
                    }

                    // Adiciona o objeto Response nos parametros da classe
                    if ($param->getType()->getName() == Response::class) {
                        $args[$i] = new Response();
                    }
                } else {
                    //Adiciona o restante dos parametros nao tipados
                    $args[$i] = $match->getArg($param->getName());
                }
            }

            call_user_func_array($match->getCallback(), $args);
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
}
