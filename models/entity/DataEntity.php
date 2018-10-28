<?php

namespace app\models\entity;

/**
 * Class DataEntity определяет свойства и методы для работы с базой данных различных объектов модели, таких как:
 * продукты, пользователи, корзина, заказы и т.д.
 * @package app\models
 */
abstract class DataEntity {

  /** @var array - Массив будет содержать список измененных свойств. */
  protected $changedValue = [];

  /**
   * Метод добавляет измененное свойство в массив со списком всех измененных или добавленных свойств.
   * @param string $name - Название свойства.
   * @param mixed $value - Значение свойства.
   */
  public function __set($name, $value) {
    if (isset($this->$name)) {
      $this->changedValue[$name] = $value;
    }
  }

  /**
   * Метод возвращает значение свойства недоступного вне класса.
   * @param string $name - Название свойства.
   * @return mixed Значение свойства.
   */
  public function __get($name) {
    if (isset($this->$name)) {
      return $this->$name;
    }
    return null;
  }

  /**
   * Метод срабатывает если запрашивается проверка свойства на существование. Если свойство существует в объекте, то
   * возвращается true, иначе false.
   * @param string $name - Имя свойства.
   * @return bool Если свойство принадлежит заданному классу или объекту, то возвращается true, иначе false.
   */
  public function __isset($name) {
    return isset($this->$name);
  }
}