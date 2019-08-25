<?php

<<<<<<< HEAD
namespace Bonfim\Router;
=======
namespace EdsonOnildo\Router;

use Symfony\Component\HttpFoundation\Request;
>>>>>>> master

/**
 * Class Router
 * @package Router
 */
class Router
{
<<<<<<< HEAD
    /**
     * @var array
     */
    private $server;
=======
    private $request;
>>>>>>> master

    /**
     * @var array
     */
    private static $routes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
<<<<<<< HEAD
        $this->server = new Server();
=======
        $this->request = Request::createFromGlobals();
>>>>>>> master
    }

    /**
     * @param array $route
     */
    public function add(array $route): void
    {
<<<<<<< HEAD
        self::$routes[] = new Client($route);
    }

    /**
     * @return null|Client
     */
    public function handle(): ?Client
=======
        $request = Request::create(
            $route['uri'],
            strtoupper($route['method'])
        );

        $request->attributes->set('callback', $route['callback']);

        self::$routes[] = $request;
    }

    /**
     * @return Request|null
     */
    public function handle(): ?Request
>>>>>>> master
    {
        foreach (self::$routes as $route) {
            if ($this->checkVerb($route) && $this->checkPath($route)) {
                return $route;
            }
        }
        return null;
    }

    /**
<<<<<<< HEAD
     * @param Client $route
     * @return bool
     */
    private function checkVerb(Client $route): bool
    {
        if ($this->server->getMethod() != $route->getMethod()) {
            return false;
        }

        return true;
    }

    /**
     * @param Client $route
     * @return bool
     */
    private function checkPath(Client $route): bool
    {
        $serverUri = $this->server->getUri();
        $routeUri = $route->getUri();

        if (count($serverUri) != count($routeUri)) {
            return false;
        }

        foreach ($routeUri as $i => $k) {

            // Verifica se o parametro e' nomeado
            if (preg_match('/@(.*)/', $k, $match)) {

                $name = $match[1];

                // Verifica se o parametro tem alguma regex
                if (preg_match('/([\w]+):(.*)/', $name, $match)) {

                    $regex = $match[2];

                    // Aplica a regex
                    if (!preg_match("/^$regex$/", $serverUri[$i])) {
                        return false;
                    }

                    // Atualiza o nome tirando a parte da regex
                    $name = $match[1];
                }

                // Adiciona o parametro na rota
                $route->setArg($name, $serverUri[$i]);

            } else {

                // Se o parametro nao for nomeado, verifica se eh igual a uri
                if ($k != $serverUri[$i]) {
                    return false;
                }
            }
        }
=======
     * @param Request $route
     * @return bool
     */
    private function checkVerb(Request $route): bool
    {
        return $this->request->isMethod('get') == $route->isMethod('get');
    }

    /**
     * @param Request $route
     * @return bool
     */
    private function checkPath(Request $route): bool
    {
        // if (count($route->getUri()) != count($this->server->getUri())) {
        //     return false;
        // }
        return $this->parsePath($route)
            && $this->request->getPathInfo() == $route->getPathInfo();
    }

    /**
     * @param Route $route
     * @return bool
     */
    private function parsePath(Request $route): bool
    {
        // for ($i = 0; $i < count($routeUri); $i++) {
        //     $serverUri[$i] = preg_replace('/\@.*/', $this->server->getUri()[$i], $routeUri[$i]);
        //     if ($serverUri[$i] != $routeUri[$i]) {
        //         // Regular expression named parameter matching
        //         if (preg_match('/\@([\w]+):(.*)/', $routeUri[$i], $match)) {
        //             if (preg_match('/'.$match[2].'/', $serverUri[$i], $match[2])) {
        //                 if ($serverUri[$i] != $match[2][0]) {
        //                     return false;
        //                 }
        //                 $route->setArg($match[1], $match[2][0]);
        //             } else {
        //                 return false;
        //             }
        //         } else {
        //             $routeUri[$i] = str_replace('@', '', $routeUri[$i]);
        //             $route->setArg(str_replace(':', '', $routeUri[$i]), $serverUri[$i]);
        //         }
        //     }
        // }
            
        // $serverUri = implode('/', $serverUri);
        // $route->setUri($serverUri);
>>>>>>> master

        return true;
    }
}
