<?php

echo "<pre>";

include '../vendor/autoload.php';

use Bonfim\Router\Request;
use Bonfim\Router\Response;
use Bonfim\Router\Route;

Route::get('/', function (Request $request) {
    echo "hello";
});

Route::get('/test/@name/@id:[\d]{1,2}', function ($id, $name, Response $response) {
    return $response->withRedirect('/');
});
