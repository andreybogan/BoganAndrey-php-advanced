<?php

namespace app\models;

class User extends Model {
  public $id;
  public $login;
  public $password;

  public function getTableName() {
    return 'users';
  }

  public function getWhereOne() {
    return "where id_user = '{$this->id}'";
  }

  public function getWhereAll() {
    return '';
  }

  public function getUserByRole() {

  }
}