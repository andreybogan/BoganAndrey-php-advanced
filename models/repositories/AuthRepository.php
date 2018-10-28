<?php

namespace app\models\repositories;

use app\models\entity\DataEntity;
use app\models\entity\User;

class AuthRepository extends Repository {

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
    $sql = "select pass from {$table} where login = :login";
    $result = $this->db->queryOne($sql, [':login' => $login]);
    // Проверяем, соответствует ли пароль хешу.
    $passHash = $result['pass'];
    unset($result['pass']);
    if (password_verify($pass, $passHash)) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Метод получает название картинки для заданного товара.
   * @param DataEntity $entity
   * @return array Возвращает массив из названий картинок.
   */
  public function getProductImg(DataEntity $entity) {
    // Составляем строку запроса.
    $sql = "select img from product_img where id_prod = :id_prod";
    // Выполняем наш запрос.
    return $this->db->queryAll($sql, [':id_prod' => $entity->id]);
  }
}