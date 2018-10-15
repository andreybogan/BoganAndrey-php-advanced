<?php
// Подключаем класс автозагрузки.
include $_SERVER['DOCUMENT_ROOT'] . "/../services\Autoloader.php";

// Регистрируем заданную функцию в качестве автозагрузчика классов.
spl_autoload_register([new app\services\Autoloader('app'), 'loadClass']);

// Создаем объект для работы с базой данных.
$db = new \app\services\Db();

// Создаем объект класса Product.
$product = new app\models\Product($db);
var_dump($product);

// Создаем объект класса Product.
$user = new app\models\User($db);
var_dump($user);

// Создаем объект класса Product.
$basket = new app\models\Basket($db);
var_dump($basket);

// Создаем объект класса Product.
$order = new app\models\Orders($db);
var_dump($order);