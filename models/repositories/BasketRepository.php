<?php

namespace app\models\repositories;

use app\models\entity\Basket;

/**
 * Class BasketRepository обеспечивает получение данных из базы для Basket.
 * @package app\models\repositories
 */
class BasketRepository extends Repository
{
    /**
     * Метод возвращает класс сущности с которой будет работать Repository.
     * @return string Имя класса.
     */
    public function getEntityClass()
    {
        return Basket::class;
    }

    /**
     * Метод возвращает название таблицы в базе данных для текущего класса.
     * @return string Название таблицы для данного класса.
     */
    public function getTableName()
    {
        return 'basket';
    }

    /**
     * Метод получает из базы данных товары в корзине для текущего пользователя и возвращает их.
     * @param string $id - ID элемента в базе данных.
     * @return array Элемент в виде объекта текущего класса.
     */
    public function getAllBasket($id)
    {
        $table = static::getTableName();
        $sql = "select {$table}.*, products.name, products.price from {$table} inner join products where {$table}.id_user = :id_user and products.id = {$table}.id_prod";
        return $this->db->queryAll($sql, [':id_user' => $id]);
    }

    /**
     * Метод возвращает количество товаров в корзине по заданному ID у текущего пользователя.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     * @return int|null Возвращает количество товаров в корзине, или null, если для заданного ID товаров нет.
     */
    public function getAmountBasketID($id_user, $id_prod)
    {
        $table = static::getTableName();
        $sql = "select amount from {$table} where id_user = :id_user and id_prod = :id_prod";
        return $this->db->queryOne($sql, [':id_user' => $id_user, ':id_prod' => $id_prod]);
    }

    /**
     * Метод изменяет информацию в базе данных о товаре прибавляя один товар.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     */
    public function updateProdToBasket($id_user, $id_prod)
    {
        $table = static::getTableName();
        // Составляем строку запроса.
        $sql = "update {$table} set amount = amount + 1 where id_user = :id_user and id_prod = :id_prod";
        // Формируем параметры.
        $params = [':id_user' => $id_user, ':id_prod' => $id_prod];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * Метод изменяет информацию в базе данных о товаре убавляя один товар.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     */
    public function updateProdFromBasket($id_user, $id_prod)
    {
        $table = static::getTableName();
        // Составляем строку запроса.
        $sql = "update {$table} set amount = amount - 1 where id_user = :id_user and id_prod = :id_prod";
        // Формируем параметры.
        $params = [':id_user' => $id_user, ':id_prod' => $id_prod];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * Метод добавляет информацию о добавленном товаре в базу данных.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     */
    public function insertProdToBasket($id_user, $id_prod)
    {
        $table = static::getTableName();
        // Собираем строку для полей таблицы.
        $columns = 'id_user, id_prod, amount';
        $placeholders = ':id_user, :id_prod, :amount';
        // Составляем строку запроса.
        $sql = "insert into {$table} ({$columns}) values ({$placeholders})";
        // Формируем параметры.
        $params = [':id_user' => $id_user, ':id_prod' => $id_prod, ':amount' => '1'];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * Метод удаляет информацию о товаре из базы данных.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     */
    public function deleteProdFromBasket($id_user, $id_prod)
    {
        $table = static::getTableName();

        // Составляем строку запроса.
        $sql = "delete from {$table} where id_prod = :id_prod and id_user = :id_user";
        // Формируем параметры.
        $params = [':id_user' => $id_user, ':id_prod' => $id_prod];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * Метод удаляет все товары из корзины у пользователя с заданным ID.
     * @param string $id Id пользователя.
     */
    public function cleanBasket($id)
    {
        $table = static::getTableName();

        // Составляем строку запроса.
        $sql = "delete from {$table} where id_user = :id_user";
        // Формируем параметры.
        $params = [':id_user' => $id];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }
}