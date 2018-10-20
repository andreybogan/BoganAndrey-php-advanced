<?php
// Подключаем класс автозагрузки.
include $_SERVER['DOCUMENT_ROOT'] . "/../services\Autoloader.php";

// Регистрируем заданную функцию в качестве автозагрузчика классов.
spl_autoload_register([new app\services\Autoloader('app'), 'loadClass']);

//// Создаем объект класса Product.
$product = new app\models\Product();
////var_dump($product);
//// Задаем параметры для нового товара.
$product->name = "Новый товар 6";
$product->description = "Это описание для нового товара 6";
$product->price = "5200";
$product->img = "newImg.jpg";
$product->hide = "see";
////var_dump($product);
//// Создаем новый товар.
$product->save();

// Получаем объект товара по заданному id.
$product1 = app\models\Product::getOne(6);
//var_dump($product1);
// Задаем новые параметры.
$product1->name = "Измененный файл 4";
$product1->description = "Измененное описание 3";
$product1->price = "4900";
$product1->img = "changeImg2.jpg";
// Изменяем товар.
$product1->save();
//var_dump($product1);

// Удаляем товар по заданному id.
//$product2 = $product->getOne(5);
//var_dump($product2);
//$product2->insert();

// Получаем все товары в виде объектов.
//$AllProduct = app\models\Product::getAll();
//
//var_dump($AllProduct);