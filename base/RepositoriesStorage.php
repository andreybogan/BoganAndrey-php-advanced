<?php
/**
 * Created by PhpStorm.
 * User: Andrey Bogan
 * Date: 01.11.2018
 */

namespace app\base;


/**
 * Class RepositoriesStorage обеспечивает хранение объектов наших репозиториев.
 * @package app\base
 */
class RepositoriesStorage
{
    private $items = [];

    /**
     * Метод помещает объект заданного элемента в массив для хранения.
     * @param $name - Название компонента или репозитория.
     * @param $object - Объект компонента или репозитория.
     */
    public function set($name, $object)
    {
        $this->items[$name] = $object;
    }

    /**
     * Метод проверяет существование объекта нашего компонента или репозитория в хранилище, если объект существует, то
     * метод возвращает его, если не существует, то создает его и возвращает.
     * @param $name - Название компонента или репозитория.
     * @return object - объект копонента или репозитория.
     * @throws \Exception
     */
    public function get($name)
    {
        if (!isset($this->items[$name])) {
            $this->items[$name] = App::call()->createRepository($name);
        }
        return $this->items[$name];
    }
}