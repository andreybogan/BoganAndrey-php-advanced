<?php

namespace app\models\entity;

/**
 * Class Basket определяет свойства и методы для работы с корзиной.
 * @package app\models
 */
class Basket extends DataEntity
{
    public $id;
    public $id_prod;
    public $id_user;
    public $amount;
}