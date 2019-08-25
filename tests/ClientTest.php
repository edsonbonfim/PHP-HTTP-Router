<?php

namespace Tests;

use Bonfim\Router\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private $route;

    public function setUp(): void
    {
        parent::setUp();

        $this->route = new Client([
            'uri' => '/',
            'name' => 'test',
            'method' => 'get',
            'callback' => 'test_callback'
        ]);

        $this->route->setUri('/index');
        $this->route->setArg('arg', 'val');
    }

    public function testRouteGetUri()
    {
        $this->assertEquals(['index'], $this->route->getUri());
    }

    public function testRouteGetName()
    {
        $this->assertEquals('test', $this->route->getName());
    }

    public function testRouteGetMethod()
    {
        $this->assertEquals('get', $this->route->getMethod());
    }

    public function testRouteGetCallback()
    {
        $this->assertEquals('test_callback', $this->route->getCallback());
    }

    public function testRouteGetArg()
    {
        $this->assertEquals('val', $this->route->getArg('arg'));
    }

    public function testRouteGetArgs()
    {
        $this->assertEquals(['arg' => 'val'], $this->route->getArgs());
    }
}
