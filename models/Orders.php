<?php

namespace app\models;

class Orders extends Model {
  public $id_order;
  public $id_user;
  public $name;
  public $description;
  public $price;
  public $producerId;

  public function getTableName() {
    return 'basket';
  }

  public function getWhereOne() {
    return "where id_order = '{$this->id_order}' and id_user = '{$this->id_user}'";
  }

  public function getWhereAll() {
    return "where id_user = '{$this->id_user}'";
  }

  public function getOrdersDelivered() {

  }
}