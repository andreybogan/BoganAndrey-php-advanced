<?php

namespace app\models\repositories;

use app\models\entity\DataEntity;
use app\services\Db;

abstract class Repository implements IRepository {

  /** @var Db */
  protected $db;

  /**
   * Конструктор инициализирует свойство с текущим подключением к базе данных.
   */
  public function __construct() {
    $this->db = static::getDb();
  }

  /**
   * Метод возвращает текущее подключение к базе данных для статических методов.
   * @return Db Текущее подключение к базе данных.
   */
  private static function getDb() {
    return Db::getInstance();
  }

  /**
   * Метод получает из базы данных элемент и возвращает его в виде объекта класса.
   * @param int $id - ID элемента в базе данных.
   * @return object Элемент в виде объекта текущего класса.
   */
  public function getOne($id) {
    $table = static::getTableName();
    $sql = "select * from {$table} where id = :id";
    $std = static::getDb()->queryObject($sql, $this->getEntityClass(), [':id' => $id]);
    return $std;
  }

  /**
   * Метод получает из базы данных массив элементов и возвращает их в виде объекта класса.
   * @return array Массив элементов в виде объектов класса.
   */
  public function getAll() {
    $table = static::getTableName();
    $sql = "select * from {$table}";
    return static::getDb()->queryArrObject($sql, $this->getEntityClass());
  }

  /**
   * Метод удаляет из базы данных информацию о текущем объекте.
   * @param DataEntity $entity - Объект сущности.
   */
  public function delete(DataEntity $entity) {
    $sql = "delete from {$this->getTableName()} where id = :id";
    $this->db->execute($sql, [':id' => $entity->id]);
  }

  /**
   * Метод вставляет данные текущего объекта в базу данных.
   * @param DataEntity $entity - Объект сущности.
   * @return mixed|void
   */
  public function insert(DataEntity $entity) {
    // Получаем название заданной таблицы.
    $table = $this->getTableName();
    // Получаем список полей в заданной таблице.
    $ArrColumnsInTable = $this->db->getArrColumnsInTable($table);
    // Инициализируем переменные для хранения полей в таблице и их параметров.
    $columns = [];
    $params = [];

    // Обходим в цикле свойства нашего массива.
    foreach ($entity as $key => $value) {
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
   * @param DataEntity $entity
   * @return mixed|void
   */
  public function update(DataEntity $entity) {
    // Получаем название заданной таблицы.
    $table = $this->getTableName();
    // Получаем список полей в заданной таблице.
    $ArrColumnsInTable = $this->db->getArrColumnsInTable($table);
    // Инициализируем переменные для хранения полей в таблице и их параметров.
    $string = [];
    $params = [];

    // Обходим в цикле свойства нашего массива.
    foreach ($entity as $key => $value) {
      // Свойства должны соответствовать полям таблицы, и их значение не null.
      if (in_array($key, $ArrColumnsInTable) && $value !== null && $value != 'id') {
        // Проверяем значения начальное и измененное, если совпадают, то пропускаем.
        if ($entity->$key != $value) {
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
   * Метод определяет какую операцию нужно запустить для объекта:
   * добавление нового товара (insert) или изменение товара (update).
   * @param DataEntity $entity - Объект сущности.
   * @return mixed|void
   */
  public function save(DataEntity $entity) {
    if (is_null($entity->id)) {
      $this->insert($entity);
    } else {
      $this->update($entity);
    }
  }
}