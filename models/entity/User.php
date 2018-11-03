<?php

namespace app\models\entity;

use app\base\App;

/**
 * Class Basket определяет свойства и методы для работы с корзиной.
 * @package app\models
 */
class User extends DataEntity
{
    public $id;
    public $login;
    public $pass;
    public $name;

    /**
     * Метод проверяет правильность заполнения регистрационной формы.
     * @param array $arrPost - Массив значений полученных из формы.
     * @param mixed $login - Логин пользователя.
     * @param mixed $pass - Пароль пользователя.
     * @return array|null Возвращет массив ошибок, либо null, если ошибок нет.
     */
    function checkRegForm($arrPost, $login, $pass, $unicLogin = false) {
        // Инициализируем массив для ошибок.
        $errors = null;

        // Проверяем что все значения переданные из формы имеют значения.
        if (!CheckFillForm($arrPost)) {
            $errors[] = "Заполните все поля формы.";
        } else {
            // Проверяем корректность заданного пользователем логина.
            if (!checkLogin($login, 5)) {
                $errors[] = "Логин не может быть короче 5 символов.";
            };

            // Проверяем логин на уникальность.
            if ($unicLogin === true) {
                if (checkLoginUnique($login)) {
                    $errors[] = "Этот логин уже занят, попробуйте выбрать другой.";
                };
            }

            // Проверяем корректность заданного пользователем пароля.
            if (!checkPass($pass, 5)) {
                $errors[] = "Пароль содержит недопустимые символы или его длина менее 5 символов.";
            };
        }
        return $errors;
    }

    /**
     * Метод обрабатывает данные, хеширует пароль и вызывает метод, который добавляет данные в базу.
     * @param mixed $login - Логин пользователя.
     * @param mixed $name - Имя пользователя.
     * @param mixed $pass - Пароль пользователя.
     */
    function addRegInfo($login, $pass, $name) {
        // Хешируем пароль.
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        // Добавляем информацию в базу данных.
        App::call()->UserRepository->addRegInfoInBd($login, $pass, $name);
    }
}