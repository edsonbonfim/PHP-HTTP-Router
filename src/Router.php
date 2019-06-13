<?php

namespace EdsonOnildo\Router;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Router
 * @package Router
 */
class Router
{
    private $request;

    /**
     * @var array
     */
    private static $routes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    /**
     * @param array $route
     */
    public function add(array $route): void
    {
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
    {
        foreach (self::$routes as $route) {
            if ($this->checkVerb($route) && $this->checkPath($route)) {
                return $route;
            }
        }
        return null;
    }

    /**
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

        return true;
    }
}
