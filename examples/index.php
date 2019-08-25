<?php

<<<<<<< HEAD
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
=======
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include '../vendor/autoload.php';

use EdsonOnildo\Router\Route;
use EdsonOnildo\Router\Request;

Route::get('/', function () {

    echo "Ola, mundo";
});

Route::get('/test', function() {

    echo 'Test';
>>>>>>> master
});
