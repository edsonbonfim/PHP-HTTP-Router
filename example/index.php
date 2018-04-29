<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include '../vendor/autoload.php';

use Router\Route;

function test($username)
{
    echo "Hello {$username}";
}

Route::get('/', function () {
    echo 'Hello';
});

Route::match(['get'], '/dashboard/@option:[\w]+/list/@id:[\d]+', function ($option, $id) {
    echo "$option $id";
});

Route::get('/user/@username:[\w]+', 'test');