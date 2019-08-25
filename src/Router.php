<?php

namespace Bonfim\Router;

/**
 * Class Router
 * @package Router
 */
class Router
{
    /**
     * @var array
     */
    private $server;

    /**
     * @var array
     */
    private static $routes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->server = new Server();
    }

    /**
     * @param array $route
     */
    public function add(array $route): void
    {
        self::$routes[] = new Client($route);
    }

    /**
     * @return null|Client
     */
    public function handle(): ?Client
    {
        foreach (self::$routes as $route) {
            if ($this->checkVerb($route) && $this->checkPath($route)) {
                return $route;
            }
        }
        return null;
    }

    /**
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

        return true;
    }
}
