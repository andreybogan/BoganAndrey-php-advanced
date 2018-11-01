<?php
/**
 * Created by PhpStorm.
 * User: Andrey Bogan
 * Date: 29.10.2018
 */

return [
    'rootDir' => __DIR__ . '/../',
    'wwwDir' => __DIR__ . '/../www/',
    'globalDir' => __DIR__ . '/../global/',
    'templateDir' => __DIR__ . '/../views/',
    'defaultController' => 'product',
    'controllersNamespace' => 'app\\controllers',
    'repositoriesNamespace' => 'app\\models\\repositories',
    'components' => [
        'db' => [
            'class' => \app\services\Db::class,
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'geek_advanced',
            'charset' => 'utf8',
        ],
        'request' => [
            'class' => \app\services\Request::class
        ],
        'renderer' => [
            'class' => \app\services\renderers\TemplateRenderer::class
        ],
        'session' => [
            'class' => \app\services\Session::class
        ],
        'auth' => [
            'class' => \app\services\Auth::class
        ],
    ],
];