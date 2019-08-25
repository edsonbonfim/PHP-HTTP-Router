<?php

namespace Bonfim\Router;

/**
 * Class Server
 * @package Router
 */
class Server
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return array
     */
    public function getUri(): array
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = preg_replace('/\?.*/', '', $uri);

        $uri = explode('/', $uri);
        $uri = array_filter($uri);
        $uri = array_values($uri);

        if (count($uri) == 0) {
            return ['index'];
        }

        return $uri;
    }
}
