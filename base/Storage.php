<?php
/**
 * Created by PhpStorm.
 * User: Andrey Bogan
 * Date: 29.10.2018
 */

namespace app\base;

/**
 * Class Storage обеспечивает хранение объектов наших компонентов и репозиториев.
 * @package app\base
 */
class Storage
{
    private $items = [];

    /**
     * Метод помещает объект заданного компонента или репозитория в массив для хранения.
     * @param $name - Название компонента или репозитория.
     * @param $object - Объект компонента или репозитория.
     * @return mixed возвращает
     */
    public function set($name, $object)
    {
        return $this->items[$name] = $object;
    }

    /**
     * Метод проверяет существование объекта нашего компонента или репозитория в хранилище, если объект существует, то
     * метод возвращает его, если не существует, то создает его и возвращает.
     * @param $name - Название компонента или репозитория.
     * @return object - объект копонента или репозитория.
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