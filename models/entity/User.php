<?php

namespace app\models\entity;

/**
 * Class Basket определяет свойства и методы для работы с корзиной.
 * @package app\models
 */
class User extends DataEntity {

  public $id;
  public $login;
  public $pass;
  public $name;
}