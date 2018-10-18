<?php
// Подключаем класс автозагрузки.
include $_SERVER['DOCUMENT_ROOT'] . "/../services\Autoloader.php";

// Регистрируем заданную функцию в качестве автозагрузчика классов.
spl_autoload_register([new app\services\Autoloader('app'), 'loadClass']);

// Создаем объект класса Product.
$product = new app\models\Product();

// Задаем параметры для нового товара.
$product->name = "Новый товар";
$product->description = "Это описание для нового товара";
$product->price = "1200";
$product->img = "newImg.jpg";
$product->hide = "see";
// Создаем новый товар.
$product->insert();

// Получаем объект товара по заданному id.
$product1 = $product->getOne(5);
// Задаем новые параметры.
$product1->name = "Измененный файл";
$product1->description = "Измененное описание";
$product1->price = "900";
$product1->img = "changeImg.jpg";
// Изменяем товар.
$product1->update();


// Удаляем товар по заданному id.
$product2 = $product->getOne(9)->delete();

// Получаем все товары в виде объектов.
$arrObjAllProduct = $product->getAll();

var_dump($arrObjAllProduct);