<?php

namespace app\models;

use app\services\Db;

/**
 * Class Model определяет свойства и методы для работы с базой данных различных объектов модели, таких как: продукты,
 * пользователи, корзина, заказы и т.д.
 * @package app\models
 */
abstract class Model implements IModel {

  /** @var Db */
  protected $db;
  /** @var array - Массив будет содержать список измененных свойств. */
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
    foreach ($this->changedValue as $key => $value) {
      // Свойства должны соответствовать полям таблицы, и их значение не null.
      if (in_array($key, $ArrColumnsInTable) && $value !== null && $value != 'id') {
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

  /**
   * Метод обновляет данные текущего объекта в базе данных.
   */
  public function update() {
    // Получаем название заданной таблицы.
    $table = $this->getTableName();
    // Получаем список полей в заданной таблице.
    $ArrColumnsInTable = $this->db->getArrColumnsInTable($table);
    // Инициализируем переменные для хранения полей в таблице и их параметров.
    $string = [];
    $params = [];

    // Обходим в цикле свойства нашего массива.
    foreach ($this->changedValue as $key => $value) {
      // Свойства должны соответствовать полям таблицы, и их значение не null.
      if (in_array($key, $ArrColumnsInTable) && $value !== null && $value != 'id') {
        // Проверяем значения начальное и измененное, если совпадают, то пропускаем.
        if ($this->$key != $value) {
          $params[":{$key}"] = $value;
          $string[] = "{$key} = :{$key}";
        }
      }
    }

    // Если количество полей, которые нужно изменить больше > 0, то делаем запрос в базу на обновление.
    if (count($string) > 0) {
      // Собираем строку для полей таблицы и их значений.
      $string = implode(", ", $string);

      // Добавляем в параметры id
      $params[":id"] = $this->id;

      // Составляем строку запроса.
      $sql = "update {$table} set {$string} where id = :id";

      // Выполняем наш запрос.
      $this->db->execute($sql, $params);
    }
  }

  /**
   * Метод добавляет измененное свойство в массив со списком всех измененных или добавленных свойств.
   * @param string $name - Название свойства.
   * @param mixed $value - Значение свойства.
   */
  public function __set($name, $value) {
    $this->changedValue[$name] = $value;
  }

  /**
   * Метод определяет какую операцию нужно запустить для объекта:
   * добавление нового товара (insert) или изменение товара (update).
   */
  public function save() {
    if (is_null($this->id)) {
      $this->insert();
    } else {
      $this->update();
    }
  }
}