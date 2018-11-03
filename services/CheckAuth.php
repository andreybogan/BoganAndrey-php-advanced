<?php

namespace app\services;


use app\base\App;
use app\models\repositories\UserRepository;

class CheckAuth
{
    /**
     * Функция проверяет правильность заполнения регистрационной формы.
     * @param array $arrPost - Массив значений полученных из формы.
     * @param mixed $login - Логин пользователя.
     * @param mixed $pass - Пароль пользователя.
     * @return array|null Возвращет массив ошибок, либо null, если ошибок нет.
     */
    public static function checkRegForm($arrPost, $login, $pass, $unicLogin = false)
    {
        // Инициализируем массив для ошибок.
        $errors = null;

        // Проверяем что все значения переданные из формы имеют значения.
        if (!static::CheckFillForm($arrPost)) {
            $errors[] = "Заполните все поля формы.";
        } else {
            // Проверяем корректность заданного пользователем логина.
            if (!static::checkLogin($login, 5)) {
                $errors[] = "Логин не может быть короче 5 символов.";
            };

            // Проверяем логина на уникальность.
            if ($unicLogin === true) {
                if (App::call()->UserRepository->checkLoginUnique($login)) {
                    $errors[] = "Этот логин уже занят, попробуйте выбрать другой.";
                };
            }

            // Проверяем корректность заданного пользователем пароля.
            if (!static::checkPass($pass, 5)) {
                $errors[] = "Пароль содержит недопустимые символы или его длина менее 5 символов.";
            };
        }
        return $errors;
    }

    /**
     * Функция проверяет что каждая переменная полученная из формы имеет значение.
     * @param array $arrForm - массив переменных полученных из формы.
     * @return bool Если все переменные имеют значение возвращается true, иначе false.
     */
    public static function CheckFillForm($arrForm)
    {
        // Проверяем что каждая переменная имеет значение.
        foreach ($arrForm as $key => $value) {
            if ((!isset($key)) || ($value == '')) {
                return false;
            }
        }
        return true;
    }

    /**
     * Функция проверяет корректность длины имени пользователя (по умолчанию: мин 5 знаков, максимум 32).
     * @param mixed $login - Имя пользователя.
     * @param int $min - Минимальная длина имени пользователя.
     * @param int $max - Максимальная длина имени пользователя.
     * @return bool Если имя пользователя корректно возвращается true, иначе - false.
     */
    public static function checkLogin($login, $min = 5, $max = 32)
    {
        // Длина имени пользователя.
        $strLogin = mb_strlen($login);
        // Проверяем совпадает ли длина имени пользователя с заданными значениями.
        if ($strLogin < $min || $strLogin > $max) {
            return false;
        }
        return true;
    }

    /**
     * Функция проверяет корректность пароля на допустимые символы и его длинну (по умолчанию: мин 10 знаков, максимум
     * 32). Если проходит проверку - true, иначе - false
     * @param mixed $pass - Пароль пользователя.
     * @param int $min - Минимальная длина пароля.
     * @param int $max - Максимальная длина пароля.
     * @return bool Если пароль корректен возвращается true, иначе - false.
     */
    public static function checkPass($pass, $min = 10, $max = 32)
    {
        // пароль может включать только алфавитные символы, цифры,
        // знаки пунктуации (-!#$%&'()*+,./:;<=>?@[\]_`{|}~),
        // а его длина должна быть в заданных пределах
        if (preg_match("/^[[:alnum:][:punct:]]{" . $min . "," . $max . "}$/", $pass)) {
            return true;
        }
        return false;
    }
}