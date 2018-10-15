<?php

namespace app\services;


interface IDb {
  public function queryOne(string $sql): array;

  public function queryAll(string $sql): array;
}