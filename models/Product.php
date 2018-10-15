<?php

namespace app\models;

class Product extends Model {
  public $id;
  public $name;
  public $description;
  public $price;
  public $producerId;

  public function getTableName() {
    return 'products';
  }

  public function getWhereOne() {
    return "where id_prod = '{$this->id}'";
  }

  public function getWhereAll() {
    return '';
  }

  public function getProductsWithDiscount() {

  }
}