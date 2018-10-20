<?php

namespace app\models;

use app\services\Db;

abstract class Model implements IModel {

  /** @var Db */
  protected $db;
  protected $changedValue = [];

  /**
   * Конструктор инициализирует свойство с текущим подключением к базе данных.
   */
  public function __construct() {
    $this->db = Db::getInstance();
  }

  /**
   * Метод получает из базы данных элемент и возвращает его в виде объекта класса.
   * @param int $id - ID элемента в базе данных.
   * @return object Элемент в виде объекта текущего класса.
   */
  public static function getOne($id) {
    $table = static::getTableName();
    $sql = "select * from {$table} where id = :id";
    $std = Db::getInstance()->queryObject($sql, get_called_class(), [':id' => $id]);
    return $std;
  }

  /**
   * Метод получает из базы данных массив элементов и возвращает их в виде объекта класса.
   * @return array Массив элементов в виде объектов класса.
   */
  public static function getAll() {
    $table = static::getTableName();
    $sql = "select * from {$table}";
    return Db::getInstance()->queryArrObject($sql, get_called_class());
  }

  /**
   * Метод удаляет из базы данных информацию о текущем объекте.
   */
  public function delete() {
    $sql = "delete from {$this->getTableName()} where id = :id";
    $this->db->execute($sql, [':id' => $this->id]);
  }

  /**
   * Метод вставляет данные текущего объекта в базу данных.
   */
  public function insert() {
    // Получаем название заданной таблицы.
    $table = $this->getTableName();
    // Получаем список полей в заданной таблице.
    $ArrColumnsInTable = $this->db->getArrColumnsInTable($table);
    // Инициализируем переменные для хранения полей в таблице и их параметров.
    $columns = [];
    $params = [];

    // Обходим в цикле свойства нашего массива.
    foreach ($this as $key => $value) {
      // Свойства должны соответствовать полям таблицы, и их значение не null.
      if (in_array($key, $ArrColumnsInTable) && $value !== null) {
        $params[":{$key}"] = $value;
        $columns[] = "{$key}";
      }
    }
    // Собираем строку для полей таблицы.
    $columns = implode(", ", $columns);
    // Собираем строку для параметров таблицы
    $placeholders = implode(", ", array_keys($params));

    // Составляем строку запроса.
    $sql = "insert into {$table} ({$columns}) values ({$placeholders})";

    // Выполняем наш запрос.
    $this->db->execute($sql, $params);

    // Присваиваем свойству ID нашего объекта значение равное ID только что вставленной строки.
    $this->id = $this->db->lastInsertId();
  }

  public function update() { var_dump($this->changedValue);
    // Получаем название заданной таблицы.
    $table = $this->getTableName();
    // Получаем список полей в заданной таблице.
    $ArrColumnsInTable = $this->db->getArrColumnsInTable($table);
    // Инициализируем переменные для хранения полей в таблице и их параметров.
//    $columns = [];
    $paramsNew = [];
    // Обходим в цикле свойства нашего массива.
    foreach ($this as $key => $value) {
      // Свойства должны соответствовать полям таблицы, и их значение не null.
      if (in_array($key, $ArrColumnsInTable) && $value !== null) {
        $paramsNew[":{$key}"] = $value;
      }
    }


//    $arr = array_diff_assoc(get_object_vars($this), get_object_vars($this->tempThis));
//    var_dump($paramsNew);
//    var_dump($this->tempThis);

  }

  public function __set($name, $value) {
    $this->changedValue[$name] = $value;
    $this->$name = '2' . $value;
//    var_dump($this->$name);
//    $this->tempThis[$name] = 1;
  }
}