<?php

include '../vendor/autoload.php';

use Router\Route;

Route::get('/', function() {
    echo "hello";
});

Route::get('/@name/@id:[0-9]{2}', function($name, $id) {
    echo "hello, $name ($id)!";
});
