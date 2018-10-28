<?php

namespace app\models\repositories;

use app\models\entity\DataEntity;
use app\models\entity\Product;

class ProductRepository extends Repository {

  /**
   * Метод возвращает класс сущности с которой будет работать Repository.
   * @return string Имя класса.
   */
  public function getEntityClass() {
    return Product::class;
  }

  /**
   * Метод возвращает название таблицы в базе данных для текущего класса.
   * @return string Название таблицы для данного класса.
   */
  public function getTableName() {
    return 'products';
  }

  /**
   * Метод получает список фотографий товара из базы и возвращает его.
   * @param DataEntity $entity - Объект сущности.
   * @return array|null Возвращается список фотографий конкретного товара в виде ассоциативного массива.
   */
  public function getProductImg(DataEntity $entity) {
    // Составляем строку запроса.
    $sql = "select img from product_img where id_prod = :id_prod";
    // Выполняем наш запрос.
    return $this->db->queryAll($sql, [':id_prod' => $entity->id]);
  }
}