<?php

namespace Bonfim\Router;

class Request
{
    private $request;

    public function __construct()
    {
        $this->request = json_decode(file_get_contents('php://input')) ?? (object) $_REQUEST;
    }

    public function get(string $name)
    {
        return $this->request->$name ?? null;
    }

    public function count()
    {
        return count($this->getBody());
    }

    public function getBody()
    {
        return (array) $this->request;
    }
}
