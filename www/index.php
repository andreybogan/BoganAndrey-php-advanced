<?php
// Поключаем файлы конфигурации и начальной загрузки.
require __DIR__ . "/../global/config.php";

// Подключаем класс автозагрузки Composer.
include $_SERVER['DOCUMENT_ROOT'] . "/../vendor\autoload.php";

// Создаем объект для обработки запросов.
$request = new \app\services\Request();

// Создаем объект для аутентификации пользователя.
$auth = new \app\services\Auth(\app\services\Db::getInstance(), $request);

// Получаем имена controller and action.
$controllerName = $request->getControllerName() ?: DEFAULT_CONTROLLER;
$actionName = $request->getActionName();

// Получаем имя класса.
$controllerClass = CONTROLLERS_NAMESPACE . "\\" . ucfirst($controllerName) . "Controller";

try {
  if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new \app\services\renderers\TemplateRenderer(), $auth);
    $controller->run($actionName);
  } else {
    throw new Exception('Нет такого конструктора');
  }
} catch (Exception $e) {
  Header('Location: /error404');
}