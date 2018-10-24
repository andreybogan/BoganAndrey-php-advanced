<?php
// Поключаем файлы конфигурации и функции.
require __DIR__ . "/../global/config.php";

// Подключаем класс автозагрузки Composer.
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor\autoload.php";

// Получаем имена controller and action.
$controllerName = $_GET['c'] ?: DEFAULT_CONTROLLER;
$actionName = $_GET['a'];

// Получаем имя класса.
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

// Если контроллер существует, то создаем его объект.
if (class_exists($controllerClass)) {
  // Если создаем объект контролллера product, то передаем в него объект TwigRenderer, иначе - TemplateRenderer.
  if ($controllerName = 'product') {
    $controller = new $controllerClass(new \app\services\renderers\TwigRenderer());
  } else {
    $controller = new $controllerClass(new \app\services\renderers\TemplateRenderer());
  }

  // Запускаем контроллер.
  $controller->run($actionName);
}