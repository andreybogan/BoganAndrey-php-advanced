<?php

namespace app\models;


interface IModel {
  public function getOne($id);

  public function getAll();

  public function getTableName();

  public function getWhereOne();

  public function getWhereAll();
}