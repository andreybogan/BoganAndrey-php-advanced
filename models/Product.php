<?php

namespace app\models;

class Product extends Model {
  public $id_prod;
  public $name;
  public $description;
  public $price;
  public $img;
  public $hide;
  public $tableName = 'products';

  public function getOne($id_prod) {
    $sql = "select * from {$this->tableName} where id_prod = :id_prod";
    $std = $this->db->queryOne($sql, __CLASS__, [':id_prod' => $id_prod]);
    return $std;
  }

  public function getAll() {
    $sql = "select * from {$this->tableName}";
    return $this->db->queryAll($sql, __CLASS__);
  }

  public function insert() {
    $sql =
      "insert into {$this->tableName} (name, description, price, img, hide) values (:name, :description, :price, :img, :hide)";
    $this->db->execute($sql, [':name' => $this->name, ':description' => $this->description, ':price' => $this->price,
      ':img' => $this->img, ':hide' => $this->hide]);
  }

  public function update() {
    $sql = "update {$this->tableName} set
      name = :name,
      description = :description,
      price = :price,
      img = :img,
      hide = :hide
      where id_prod = :id_prod";

    $this->db->execute($sql,
                       [':id_prod' => $this->id_prod, ':name' => $this->name, ':description' => $this->description,
                         ':price' => $this->price,
                         ':img' => $this->img, ':hide' => $this->hide]);
  }

  public function delete() {
    $sql = "delete from {$this->tableName} where id_prod = :id_prod";

    $this->db->execute($sql, [':id_prod' => $this->id_prod]);
  }
}