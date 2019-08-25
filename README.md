<<<<<<< HEAD
PHP Router
==========

[![Latest Version][ico-version]][link-version]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![StyleCI][ico-styleci]][link-styleci]

A fast and powerful router that maps route callbacks to specific HTTP request methods and URIs. It supports parameters and pattern matching.

Installation
------------

Require via [composer](https://getcomposer.org/download/)

``` sh
$ composer require edsononildo/router:^1.0
```

Documentation
-------------

[Check out the documentation](https://EdsonOnildoJR.github.io/Router).

Contributing
------------

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

Security
--------

If you discover any security related issues, please email inbox.edsononildo@gmail.com instead of using the issue tracker.

Credits
-------

* [Edson Onildo][link-author]
* [All Contributors][link-contributors]

License
-------

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/github/release/EdsonOnildoJR/Router.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/EdsonOnildoJR/Router/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/EdsonOnildoJR/Router.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/EdsonOnildoJR/Router.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/124523883/shield?branch=master

[link-version]:https://github.com/EdsonOnildoJR/Router/releases
[link-travis]: https://travis-ci.org/EdsonOnildoJR/Router
[link-scrutinizer]: https://scrutinizer-ci.com/g/EdsonOnildoJR/Router/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/EdsonOnildoJR/Router
[link-styleci]: https://styleci.io/repos/124523883
[link-author]: https://github.com/EdsonOnildoJR
[link-contributors]: https://github.com/EdsonOnildoJR/Router/contributors
=======
PHP-Http-Router
===============

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A fast and powerful router that maps route callbacks to specific HTTP request methods and URIs. It supports parameters and pattern matching.

Table of Contents
-----------------

* [Prerequisites](#prerequisites)
* [Installation](#installation)
* [Basic Usage](#basic-usage)
* [Routing](#routing)
* [Method Routing](#method-routing)
* [Named Parameters](#named-parameters)
* [Contributing](#contributing)
* [Security](#security)
* [Credits](#credits)
* [License](#license)

Prerequisites
-------------

PHP 7.1+

Installation
------------

Via Composer

``` bash
$ composer require edsononildo/router
```

Basic Usage
-----------

Include the autoloader of composer:

```php
<?php

include 'vendor/autoload.php';
```

and define your routes:

```php
use Router\Route;

Route::get('/', function () {
    echo 'Hello World!';
});
```

Routing
-------

The routing is done by matching a URL pattern with a callback function:

```php
Route::get('/', function () {
    echo 'Hello World!';
});
```

The callback can be any object that is callable. So you can use a regular function:

```php
function hello()
{
    echo 'Hello World!';
}

Route::get('/', 'hello');
```

Or a class method:

```php
class Greeting
{
    public static function hello()
    {
        echo 'Hello World!';    
    }
}

Route::get('/', ['Greeting', 'hello']);
```

Or an object method:

```php
class Greeting
{
    private $name;

    public function __construct()
    {
        $this->name = 'Edson Onildo';
    }

    public function hello()
    {
        echo 'Hello, {$this->name}!';    
    }
}

$greeting = new Greeting();

Route::get('/', [$greeting, 'hello']);
```

Routes are matched in the order they are defined. The first route to match a request will be invoked.

Method Routing
--------------

The router allows you to register routes that respond to any HTTP verb:

```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
```

You may register a route that responds to multiple verbs using the ```match``` method:

```php
Route::match(['get', 'post'], '/', function() {
    //
});
```

Or, you may even register a route that responds to all HTTP verbs using the ```any``` method:

```php
Route::any('/', function() {
    //
});
```

And, of course, you may set a ```default``` route that will be executed when there is no match:

```php
Route::default(function() {
    //
});
```

If there is more than one call to the default route, only the last one will be executed.

Named Parameters
----------------

You may specify named parameters in your routes which will be passed along to your callback function:

```php
Route::get('/@name/@id', function($name, $id) {
    echo "hello, $name ($id)!";
});
```

You can also include regular expressions with your named parameters by using the : delimiter:

```php
Route::get('/@name/@id:[0-9]{3}', function($name, $id) {
    // This will match /bob/123
    // But will not match /bob/12345
});
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email inbox.edsononildo@gmail.com instead of using the issue tracker.

## Credits

- [Edson Onildo][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/edsononildo/router.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/EdsonOnildoJR/PHP-Http-Router/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/EdsonOnildoJR/PHP-Http-Router.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/EdsonOnildoJR/PHP-Http-Router.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/edsononildo/router.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/edsononildo/router
[link-travis]: https://travis-ci.org/EdsonOnildoJR/PHP-Http-Router
[link-scrutinizer]: https://scrutinizer-ci.com/g/EdsonOnildoJR/PHP-Http-Router/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/EdsonOnildoJR/PHP-Http-Router
[link-downloads]: https://packagist.org/packages/edsononildo/router
[link-author]: https://github.com/EdsonOnildoJR
[link-contributors]: ../../contributors
>>>>>>> master
