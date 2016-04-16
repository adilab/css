Adi CSS Tools for PHP
========================

Adi CSS Tools for PHP is a very intuitive tool for prepare CSS strings directly in PHP code.

Installing
----------

Preferred way to install is with [Composer](https://getcomposer.org/).

Install this library using composer:

```console
$ composer require adilab/css
```

Usage:
-------------
Usage of Css class.
```php
require('vendor/autoload.php');

use Adi\Css\Css;

$css = new Css('display: inline-block;margin-right: 10px;min-width: 150px;');
$css->set('width: 20px');
$css->set('color', '#ff0000')->set('background-color: #ccc');

echo "<div style='{$css}'>Hello world</div>";
```