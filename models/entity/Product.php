<?php

namespace app\models\entity;

/**
 * Class Product определяет свойства и методы для работы с товарами. Получение информации о товарах в каталоге,
 * подробную информацию о товаре, изменение и удаление товара и т.д.
 * @package app\models
 */
class Product extends DataEntity
{
    protected $id;
    protected $name;
    protected $text;
    protected $price;
    protected $img;
    protected $hide;
}