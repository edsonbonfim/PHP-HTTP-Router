<?php

namespace EdsonOnildo\Router;

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
        $uri = explode('/', $_REQUEST['PATH_INFO']);
        $uri = array_filter($uri);
        $uri = array_values($uri);

        if (count($uri) == 0) {
            return ['index'];
        }

        return $uri;
    }
}
