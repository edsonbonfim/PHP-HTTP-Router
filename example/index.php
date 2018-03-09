<?php

include '../vendor/autoload.php';

use Bonfim\Component\Routing\Route;

Route::get('/', 'HomeController::index');
Route::get('/user/:username([\w]+)/post/:id([0-9]+)', 'UsersController::showPost');

var_dump(Route::match());
