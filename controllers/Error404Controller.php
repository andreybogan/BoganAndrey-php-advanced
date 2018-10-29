<?php

namespace app\controllers;

/**
 * Class BasketController
 * @package app\controllers
 */
class Error404Controller extends Controller
{
    /**
     * Метод выводит html страницу корзины.
     */
    public function actionIndex()
    {
        // Получаем id пользователя.
        $name = $this->auth->getUser()->name;

        // Выводим html страницу с полным описание товара.
        echo $this->render('404', ['model' => $name]);
    }
}