<?php

namespace app\models\repositories;

use app\models\entity\Basket;

/**
 * Class OrderRepository обеспечивает получение данных из базы для Order.
 * @package app\models\repositories
 */
class OrderRepository extends Repository
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
        return 'orders';
    }

    /**
     * Метод получает из базы данных заказы текущего пользователя и возвращает их.
     * @param string $id - ID элемента в базе данных.
     * @return array Элемент в виде объекта текущего класса.
     */
    public function getAllOrders($id)
    {
        $table = static::getTableName();
        $sql = "select * from {$table} where id_user = :id_user";
        return $this->db->queryAll($sql, [':id_user' => $id]);
    }
}