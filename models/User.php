<?php

namespace app\models;

class User extends Model {
  public $id;
  public $login;
  public $password;

  public function getTableName() {
    return 'users';
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