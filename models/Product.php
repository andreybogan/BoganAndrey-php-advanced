<?php

namespace app\models;

class Product extends Model {
  protected $id;
  protected $name;
  protected $description;
  protected $price;
  protected $img;
  protected $hide;

  /**
   * Метод возвращает название таблицы в базе данных для текущего класса.
   * @return string Название таблицы для данного класса.
   */
  public static function getTableName() {
    return 'products';
  }
}