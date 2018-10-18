<?php

namespace app\models;

use app\services\Db;

abstract class Model implements IModel {

  protected $db;

  public function __construct() {
    $this->db = Db::getInstance();
  }
}