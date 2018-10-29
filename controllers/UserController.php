<?php

namespace app\controllers;

/**
 * Class ProductController
 * @package app\controllers
 */
class UserController extends Controller
{
    /**
     * Метод выводит html страницу каталога.
     */
    public function actionIndex()
    {
        // Получаем данные пользователя.
        $model = $this->auth->getUser();

        // Выводим html страницу с полным описание товара.
        echo $this->render('user', ['model' => $model, 'text' => 'myText']);
    }

    /**
     * Метод выводит html страницу с полным описание товара.
     */
    public function actionLogin()
    {
        // Получаем логин и пароль из формы.
        $login = $paramsPost['login']['login'] ?? '';
        $pass = $paramsPost['login']['pass'] ?? '';
        $errors[] = '';
        echo $this->render('login',
            [
                'login' => $login,
                'pass' => $pass,
                'errors' => $errors,
            ]);
    }
}