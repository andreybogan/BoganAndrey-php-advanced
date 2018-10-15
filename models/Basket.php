<?php

namespace app\models;

class Basket extends Model {
  public $id_prod;
  public $id_user;
  public $name;
  public $description;
  public $price;
  public $producerId;

  public function getTableName() {
    return 'basket';
  }

  public function getWhereOne() {
    return "where id_prod = '{$this->id_prod}' and id_user = '{$this->id_user}'";
  }

  public function getWhereAll() {
    return "where id_user = '{$this->id_user}'";
  }

  public function getTotalAmount() {

  }
}