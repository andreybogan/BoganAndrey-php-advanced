<?php
/**
 * Created by PhpStorm.
 * User: Andrey Bogan
 * Date: 29.10.2018
 */

namespace app\base;

/**
 * Class Storage обеспечивает хранение объектов наших компонентов.
 * @package app\base
 */
class Storage
{
    private $items = [];

    /**
     * Метод помещает объект заданного компонента в массив для хранения.
     * @param $name - Название компонента.
     * @param $object - Объект компонента.
     * @return mixed возвращает
     */
    public function set($name, $object)
    {
        return $this->items[$name] = $object;
    }

    /**
     * Метод проверяет существование объекта нашего компонента в хранилище, если объект существует, то метод возвращает
     * его, если не существует, то создает его и возвращает.
     * @param $name - Название компонента.
     * @return object - объект копонента.
     * @throws \ReflectionException - Исключение класса \ReflectionException.
     */
    public function get($name)
    {
        if (!isset($this->items[$name])) {
            $this->items[$name] = App::call()->createComponent($name);
        }
        return $this->items[$name];
    }
}