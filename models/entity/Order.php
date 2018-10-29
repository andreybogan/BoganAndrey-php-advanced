<?php

namespace app\models\entity;

/**
 * Class Order определяет свойства и методы для работы с заказами.
 * @package app\models\entity
 */
class Order extends DataEntity
{
    public $id_order;
    public $id_user;
    public $date;
    public $address;
    public $status;
    public $total;
}