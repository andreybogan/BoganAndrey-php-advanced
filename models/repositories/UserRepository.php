<?php

namespace app\models\repositories;

use app\models\entity\User;

class UserRepository extends Repository {

  /**
   * Метод возвращает класс сущности с которой будет работать Repository.
   * @return string Имя класса.
   */
  public function getEntityClass() {
    return User::class;
  }

  /**
   * Метод возвращает название таблицы в базе данных для текущего класса.
   * @return string Название таблицы для данного класса.
   */
  public function getTableName() {
    return 'users';
  }

  /**
   * Функция проверяет существует ли в базе пользователем с полученным именем пользователя и паролем.
   * @param mixed $login - Имя пользователе.
   * @param mixed $pass - Пароль пользователя.
   * @return bool Если пользователь существует возвращает true, иначе - false.
   */
  function isAuth($login, $pass) {
    $table = static::getTableName();
    // Проверяем, есть ли в базе информация по данному имени пользователя, если есть, то получаем хеш пароля.
    $sql = "select id, name, pass from {$table} where login = :login";
    $result = $this->db->queryOne($sql, [':login' => $login]);
    // Проверяем, соответствует ли пароль хешу.
    $passHash = $result['pass'];
    unset($result['pass']);
    if (password_verify($pass, $passHash)) {
      return $result;
    } else {
      return false;
    }
  }

  /**
   * Метод получает из базы данных элемент и возвращает его в виде объекта класса.
   * @param string $login - ID элемента в базе данных.
   * @return object Элемент в виде объекта текущего класса.
   */
  public function getOneWithLogin($login) {
    $table = static::getTableName();
    $sql = "select id, login, name from {$table} where login = :login";
    $std = $this->db->queryObject($sql, $this->getEntityClass(), [':login' => $login]);
    return $std;
  }
}