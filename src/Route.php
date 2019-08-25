<?php

<<<<<<< HEAD
namespace Bonfim\Router;

use ReflectionException;
use ReflectionFunction;
=======
namespace EdsonOnildo\Router;

use Symfony\Component\HttpFoundation\Request;
>>>>>>> master

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

<<<<<<< HEAD
=======
    /**
     * @var null
     */
    private static $defaultCallback = null;
>>>>>>> master

    /**
     * Route constructor.
     */
    private function __construct()
    {
        $this->router = new Router();
    }

    /**
<<<<<<< HEAD
=======
     * Route destructor.
     */
    public function __destruct()
    {
        if (!$this->status) {
            $callback = self::$defaultCallback;
            if (is_callable($callback)) {
                $callback();
                unset($_SESSION['sketch']['errors']);
                exit;
            }
        }
    }

    /**
>>>>>>> master
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
<<<<<<< HEAD
     * @return null|Client
     */
    private static function dispatch(): ?Client
=======
     * @return Request|null
     */
    private static function dispatch(): ?Request
>>>>>>> master
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
<<<<<<< HEAD
     * @throws ReflectionException
     */
    private function handle(string $method, string $uri, \Closure $callback): void
    {
        $this->router->add([
            'uri' => $uri,
            'name' => '',
            'method' => $method,
            'callback' => $callback
=======
     */
    private function handle(string $method, string $uri, $callback): void
    {
        $this->router->add([
            'uri' => $uri,
            'method' => $method,
            'callback' => $callback,
>>>>>>> master
        ]);

        $match = $this->dispatch();

<<<<<<< HEAD
        $args = [];

        if ($match) {
            $reflect = new ReflectionFunction($callback);

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
=======
        if ($match) {
            $callback = $match->attributes->get('callback');
            $callback();
>>>>>>> master
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
<<<<<<< HEAD
=======

    /**
     * @param $callback
     */
    public static function default($callback): void
    {
        self::$defaultCallback = $callback;
    }
>>>>>>> master
}
