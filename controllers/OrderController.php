<?php

namespace app\controllers;

use app\models\repositories\OrderRepository;

/**
 * Class OrderController
 * @package app\controllers
 */
class OrderController extends Controller {

  /**
   * Метод выводит html страницу корзины.
   */
  public function actionIndex() {
    // Получаем id пользователя.
    $id = $this->auth->getUser()->id;
    // Получаем объект товара.
    $model = (new OrderRepository())->getAllOrders($id);

    // Выводим html страницу с полным описание товара.
    echo $this->render('orders', ['model' => $model]);
  }
}