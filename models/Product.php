<?php

namespace app\models;

class Product extends Model {
  public $id;
  protected $name;
  protected $description;
  protected $price;
  protected $img;
  protected $hide;

  public static function getTableName() {
    return 'products';
  }
}