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

  public function getOne($id_prod) {
    return [];
  }

  public function getAll() {
    return [];
  }

  public function update() {
    return [];
  }

  public function insert() {
    return [];
  }

  public function delete() {
    return [];
  }
}