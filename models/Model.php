<?php

namespace app\models;

use app\services\IDb;

abstract class Model implements IModel {
  /** @var IDb */
  protected $db;

  /**
   * Product constructor.
   * @param IDb $db
   */
  public function __construct(IDb $db) {
    $this->db = $db;
  }

  public function getOne($id) {
    $sql = "select * from {$this->getTableName()} {$this->getWhereOne()}";
    return $this->db->queryOne($sql);
  }

  public function getAll() {
    $sql = "select * from {$this->getTableName()} {$this->getWhereAll()}";
    return $this->db->queryAll($sql);
  }
}