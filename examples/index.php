<?php

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
});
