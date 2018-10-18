<?php

namespace app\services;

use app\traits\TSingleton;

class Db {
  use TSingleton;

  private $config = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'login' => 'root',
    'password' => '',
    'database' => 'geek_advanced',
    'charset' => 'utf8',
  ];

  protected $conn = null;

  protected function getConnection() {
    if (is_null($this->conn)) {
      $this->conn = new \PDO(
        $this->prepareDsnString(),
        $this->config['login'],
        $this->config['password']
      );
      $this->conn->setAttribute(
        \PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC
      );
    }
    return $this->conn;
  }

  private function prepareDsnString(): string {
    return sprintf("%s:host=%s;dbname=%s;charset=%s",
                   $this->config['driver'],
                   $this->config['host'],
                   $this->config['database'],
                   $this->config['charset']
    );
  }

  private function query($sql, array $params = []) {
    $pdoStatement = $this->getConnection()->prepare($sql);
    $pdoStatement->execute($params);
    return $pdoStatement;
  }

  public function queryOne(string $sql, $class, array $params = []) {
    return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, $class)[0];
  }

  public function queryAll(string $sql, $class, array $params = []) {
    return $this->query($sql, $params)->fetchAll(\PDO::FETCH_CLASS, $class);
  }

  public function execute(string $sql, array $params = []) {
    $this->query($sql, $params);
  }
}