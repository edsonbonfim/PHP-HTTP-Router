<?php

include '../vendor/autoload.php';

use EdsonOnildo\Router\Route;
use EdsonOnildo\Router\Request;

Route::get('/', function (Request $request) {

    echo "Ola mundo";
});
