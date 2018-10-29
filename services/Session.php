<?php
/**
 * Created by PhpStorm.
 * User: Andrey Bogan
 * Date: 29.10.2018
 */

namespace app\services;

/**
 * Class Session содержит методы для работы с сессией.
 */
class Session
{
    /**
     * Session constructor запускает сессию с заданным именем.
     * @param $session_name - Название новой сессии.
     */
    public function __construct($session_name)
    {
        // Устанавливаем имя текущей сессии.
        session_name($session_name);
        // Стартуем новую сессию.
        session_start();
    }

    /**
     * Метод возвращает значение массива $_SESSION по заданному ключу.
     * @param $key - Заданный ключ.
     * @return mixed возвращает значение по заданному ключу.
     */
    public function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * Метод изменяет значение массива $_SESSION по заданному ключу.
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}