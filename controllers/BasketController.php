<?php

namespace app\controllers;

use app\models\repositories\BasketRepository;

/**
 * Class BasketController
 * @package app\controllers
 */
class BasketController extends Controller
{
    /**
     * Метод выводит html страницу корзины.
     */
    public function actionIndex()
    {
        // Получаем id пользователя.
        $id = $this->auth->getUser()->id;
        // Получаем объект товара.
        $model = (new BasketRepository())->getAllBasket($id);

        // Выводим html страницу с полным описание товара.
        echo $this->render('basket', ['model' => $model]);
    }
}