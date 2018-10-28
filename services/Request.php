<?php

namespace app\services;

class Request {

  private $controllerName;
  private $actionName;
  private $id;
  private $params;
  private $request_uri;

  public function __construct() {
    $this->parseRequest();
  }


  public function parseRequest() {
    $this->params['get'] = $_GET;
    $this->params['post'] = $_POST;
    $this->controllerName = $_GET['c'];
    $this->actionName = $_GET['a'];
    $this->id = $_GET['id'];
    $this->request_uri = $_SERVER['REQUEST_URI'];
  }

  public function getControllerName() {
    if (!empty($this->controllerName)) {
      return $this->controllerName;
    }
    return null;
  }

  public function getActionName() {
//    return $this->actionName;
    if (!empty($this->actionName)) {
      return $this->actionName;
    }
    return null;
  }

  public function getId() {
    if (!empty($this->id)) {
      return $this->id;
    }
    return null;
  }

  public function getRequestUri() {
    if (!empty($this->request_uri)) {
      return $this->request_uri;
    }
    return null;
  }

  public function getParams() {
    return $this->params;
  }

  public function get($name) {
    if (isset($this->params['get'][$name])) {
      return $this->params['get'][$name];
    }
    return null;
  }

  public function post($name) {
    if (isset($this->params['post'][$name])) {
      return $this->params['post'][$name];
    }
    return null;
  }

  public function getMethod() {
    if (!empty($this->params['get']) && empty($this->params['post'])) {
      return 'get';
    }
    if (empty($this->params['get']) && !empty($this->params['post'])) {
      return 'post';
    }
    return 'both';
  }
}