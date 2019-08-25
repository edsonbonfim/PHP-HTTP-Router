<?php

echo "<pre>";

include '../vendor/autoload.php';

use Bonfim\Router\Request;
use Bonfim\Router\Response;
use Bonfim\Router\Route;

class Home
{
    public static function index(Request $request)
    {
        echo $request->get('name');
    }
}

Route::get('/', ['Home', 'index']);

Route::get('/test/@name/@id:[\d]{1,2}', function ($id, $name, Response $response) {
    return $response->withRedirect('/');
});
