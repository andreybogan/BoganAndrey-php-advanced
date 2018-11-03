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
     * Метод возвращает название таблицы для хранения элементов заказа.
     * @return string Название таблицы.
     */
    public function getTableItemsName()
    {
        return 'order_items';
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

    /**
     * Метод добавляет данные заказа в таблицу.
     * @param string $id_user - ID пользователя.
     * @param string $time - Время добавления unit.
     * @param string $address - Адрес доставки заказа.
     * @param string $total - Общая сумма заказа.
     */
    public function addOrder($id_user, $time, $address, $total)
    {
        $table = static::getTableName();

        // Собираем строку для полей таблицы.
        $columns = 'id_user, date, address, total';
        $placeholders = ':id_user, :date, :address, :total';

        // Составляем строку запроса.
        $sql = "insert into {$table} ({$columns}) values ({$placeholders})";
        // Формируем параметры.
        $params = [':id_user' => $id_user, ':date' => $time, ':address' => $address, ':total' => $total];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }

    /**
     * Метод добавляем элементы заказа в базу данных.
     * @param $arrAllProdBasket - ассициативный массив элементов заказа.
     * @param $lastInsertId - Id текущего заказа.
     */
    public function addOrderItems($arrAllProdBasket, $lastInsertId)
    {
        $table = static::getTableItemsName();

        // Собираем строку для полей таблицы.
        $columns = 'id_order, id_prod, item_price, quantity, name';
        $placeholders = ':id_order, :id_prod, :item_price, :quantity, :name';

        // Составляем строку запроса.
        $sql = "insert into {$table} ({$columns}) values ({$placeholders})";

        // Обходим в цикле все товары в корзине и добавляем их в таблицу order_items.
        foreach ($arrAllProdBasket as $value) {
            // Формируем параметры.
            $params = [
                ':id_order' => $lastInsertId,
                ':id_prod' => $value['id_prod'],
                ':item_price' => $value['price'],
                ':quantity' => $value['amount'],
                ':name' => $value['name']
            ];
            // Выполняем наш запрос.
            $this->db->execute($sql, $params);
        }
    }

    public function cancelOrder($id_order)
    {
        $table = static::getTableName();

        // Составляем строку запроса.
        $sql = "update {$table} set status = 'cancelled' where id_order = :id_order";

        // Формируем параметры.
        $params = [':id_order' => $id_order];

        // Выполняем наш запрос.
        $this->db->execute($sql, $params);
    }
}