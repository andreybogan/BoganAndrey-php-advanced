<?php

namespace app\services;

class Db implements IDb {
  public function queryOne(string $sql): array {
    return [];
  }

  public function queryAll(string $sql): array {
    return [];
  }
}