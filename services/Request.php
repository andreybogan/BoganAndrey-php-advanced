<?php

namespace app\services;

/**
 * Класс для работы с глобальным массивом REQUEST, POST, GET.
 * Class Request
 * @package app\services
 */
class Request
{
    private $controllerName;
    private $actionName;
    private $id;
    private $params;
    private $request_uri;

    /**
     * Request constructor инициализирует свойства класса.
     */
    public function __construct()
    {
        $this->params['get'] = $_GET;
        $this->params['post'] = $_POST;
        $this->controllerName = $_GET['c'];
        $this->actionName = $_GET['a'];
        $this->id = $_GET['id'];
        $this->request_uri = $_SERVER['REQUEST_URI'];
    }

    /**
     * @return null|string Возвращает имя контроллера, если его нет, то null.
     */
    public function getControllerName()
    {
        if (!empty($this->controllerName)) {
            return $this->controllerName;
        }
        return null;
    }

    /**
     * @return null|string Возвращает имя экшена, если его нет, то null.
     */
    public function getActionName()
    {
        if (!empty($this->actionName)) {
            return $this->actionName;
        }
        return null;
    }

    /**
     * @return null|int Возвращает id, если его нет, то null.
     */
    public function getId()
    {
        if (!empty($this->id)) {
            return $this->id;
        }
        return null;
    }

    /**
     * @return null|string Взвращает $_SERVER['REQUEST_URI'];
     */
    public function getRequestUri()
    {
        if (!empty($this->request_uri)) {
            return $this->request_uri;
        }
        return null;
    }

    /**
     * @return array Взвращает массив с ключами get и post, а так же их значениями.
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $name - Имя свойства $_GET.
     * @return mixed Возвращаефт значение свойства $name в массиве $_GET.
     */
    public function get($name)
    {
        if (isset($this->params['get'][$name])) {
            return $this->params['get'][$name];
        }
        return null;
    }

    /**
     * @param $name - Имя свойства $_POST.
     * @return mixed Возвращаефт значение свойства $name в массиве $_POST.
     */
    public function post($name)
    {
        if (isset($this->params['post'][$name])) {
            return $this->params['post'][$name];
        }
        return null;
    }

    /**
     * @return string Возвращает название метода, которым были переданы значения: get, post или both.
     */
    public function getMethod()
    {
        if (!empty($this->params['get']) && empty($this->params['post'])) {
            return 'get';
        }
        if (empty($this->params['get']) && !empty($this->params['post'])) {
            return 'post';
        }
        return 'both';
    }
}