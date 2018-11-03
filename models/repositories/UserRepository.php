<?php

namespace app\models\repositories;

use app\models\entity\User;

/**
 * Class UserRepository обеспечивает получение данных из базы для User.
 * @package app\models\repositories
 */
class UserRepository extends Repository
{
    /**
     * Метод возвращает класс сущности с которой будет работать Repository.
     * @return string Имя класса.
     */
    public function getEntityClass()
    {
        return User::class;
    }

    /**
     * Метод возвращает название таблицы в базе данных для текущего класса.
     * @return string Название таблицы для данного класса.
     */
    public function getTableName()
    {
        return 'users';
    }

    /**
     * Функция проверяет существует ли в базе пользователем с полученным именем пользователя и паролем.
     * @param mixed $login - Имя пользователе.
     * @param mixed $pass - Пароль пользователя.
     * @return bool Если пользователь существует возвращает true, иначе - false.
     */
    function isAuth($login, $pass)
    {
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
    public function getOneWithLogin($login)
    {
        $table = static::getTableName();
        $sql = "select id, login, name from {$table} where login = :login";
        $std = $this->db->queryObject($sql, $this->getEntityClass(), [':login' => $login]);
        return $std;
    }

    /**
     * Метод проверяет введенный пользователем логин на уникальность.
     * @param string $login - Логин пользователя.
     * @return bool Если логин уже существует, то возвращается true, иначе - false.
     */
    function checkLoginUnique($login)
    {
        $table = static::getTableName();
        $sql = "select id from {$table} where login = :login";
        $std = $this->db->queryOne($sql, [':login' => $login]);


        // Проверяем, есть ли в базе информация по данному имени пользователя, если есть, то возвращаем true.
        if ($std) {
            return true;
        }
        return false;
    }

    /**
     * Метод заносит данные пользователя в базу данных.
     * @param mixed $login - Логин пользователя.
     * @param mixed $name - Имя пользователя.
     * @param mixed $pass - Пароль пользователя.
     */
    function addRegInfoInBd($login, $pass, $name)
    {
        $table = static::getTableName();

        // Собираем строку для полей таблицы.
        $columns = 'login, pass, name';
        $placeholders = ':login, :pass, :name';

        // Составляем строку запроса.
        $sql = "insert into {$table} ({$columns}) values ({$placeholders})";

        // Формируем параметры.
        $params = [':login' => $login, ':pass' => $pass, ':name' => $name];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }
}