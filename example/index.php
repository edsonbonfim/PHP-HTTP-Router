<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include '../vendor/autoload.php';

use Router\Route;

Route::get('/', 'HomeController::index');
Route::get('/user/:username([\w]+)/post/:id([0-9]+)', 'UsersController::showPost');

var_dump(Route::match());
