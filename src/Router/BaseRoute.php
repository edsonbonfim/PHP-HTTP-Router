<?php

namespace Router;

/**
 * Class BaseRoute
 * @package Router
 */
class BaseRoute
{
    /**
     * @var mixed
     */
    private $uri;

    /**
     * @var mixed
     */
    private $name;

    /**
     * @var mixed
     */

    private $method;
    /**
     * @var mixed
     */

    private $callback;

    /**
     * @var array
     */
    private $args = [];

    /**
     * BaseRoute constructor.
     * @param array $route
     */
    public function __construct(array $route)
    {
        $this->uri = $route['uri'];
        $this->name = $route['name'];
        $this->method = $route['method'];
        $this->callback = $route['callback'];
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * @return array|mixed
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getArg($key)
    {
        return $this->args[$key];
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setArg(string $key, string $value): void
    {
        $this->args[$key] = $value;
    }
}
