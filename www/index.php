<?php
// Поключаем файлы конфигурации и начальной загрузки.
$config = require __DIR__ . "/../global/config.php";

// Подключаем класс автозагрузки Composer.
require __DIR__ . "/../vendor\autoload.php";

// Запускаем приложение.
\app\base\App::call()->run($config);