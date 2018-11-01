<?php

namespace app\controllers;

use app\base\App;

/**
 * Class OrderController
 * @package app\controllers
 */
class OrderController extends Controller
{
    /**
     * Метод выводит html страницу корзины.
     */
    public function actionIndex()
    {
        // Получаем id пользователя.
        $id = $this->auth->getUser()->id;
        // Получаем объект товара.
        $model = App::call()->OrderRepository->getAllOrders($id);

        // Выводим html страницу с полным описание товара.
        echo $this->render('orders', ['model' => $model]);
    }
}