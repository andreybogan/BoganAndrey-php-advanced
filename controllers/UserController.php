<?php

namespace app\controllers;

use app\base\App;
use app\models\entity\User;
use app\services\CheckAuth;

/**
 * Class ProductController
 * @package app\controllers
 */
class UserController extends Controller
{
    /**
     * Метод выводит html страницу пользователя.
     */
    public function actionIndex()
    {
        // Получаем данные пользователя.
        $model = $this->auth->getUser();

        // Выводим html страницу с полным описание товара.
        echo $this->render('user', ['model' => $model, 'text' => 'myText']);
    }

    /**
     * Метод выводит html страницу для авторизации пользователя.
     */
    public function actionLogin()
    {
        $errors[] = '';
        echo $this->render('login',
            [
                'errors' => $errors,
            ]);
    }

    /**
     * Метод выводит html страницу для регистрации пользователя.
     */
    public function actionRegister()
    {
        // Получаем данные переданные в post[reg].
        $postReg = App::call()->request->post('reg');

        // Проверяем нажата ли кнопка Зарегистрироваться.
        if ($postReg['submit']) {
            // Создаем короткие имена переменых.
            $login = $postReg['login'] ?? '';
            $name = $postReg['name'] ?? '';
            $pass = $postReg['pass'] ?? '';

            // Проверяем корректность заполнения формы.
            if (empty($errors = CheckAuth::checkRegForm($postReg, $login, $pass, true))) {
                // Добавляем регистрационную информацию в базу данных.
                (new User())->addRegInfo($login, $pass, $name);
                // Регистрируем идентификатор пользователя.
                App::call()->session->set('user', $login);
                // Делаем переадресацию на страницу пользователя.
                header("Location: ../user");
                exit;
            };
        }

        // Подключаем html страницу корзины.
        echo $this->render("register",
            [
                'errors' => $errors,
                'login' => $login,
                'name' => $name,
                'title' => 'Регистрация пользователя'
            ]);
    }
}