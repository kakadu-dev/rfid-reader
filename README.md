# yii2-rfid-reader
Extension provide library for Rfid Reader

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kakadu-dev/yii2-rfid-reader "@dev"
```

or add

```
"kakadu-dev/yii2-rfid-reader": "@dev"
```

to the require section of your `composer.json` file.

Usage
-----

Once the extension is installed, simply use it in your code by:

Add component to main.php file:

```
common/  
    config/
        main.php
```

```php
'rfidConnection' => [
    'class' => \Kakadu\Yii2RfidReader\Connection::class,
],

```

That's all. Check it.