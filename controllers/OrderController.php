<?php

namespace app\controllers;

use app\base\App;
use app\models\entity\Order;

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
        $id = App::call()->auth->getUser()->id;
        // Получаем объект репозитория Заказов.
        $orderRepository = App::call()->OrderRepository;

        // Если была нажата кнопка добавить заказ.
        (new Order())->isSubmitAddOrder();

        // Получаем объект товара.
        $model = $orderRepository->getAllOrders($id);

        // Выводим html страницу с полным описание товара.
        echo $this->render('orders', ['model' => $model]);
    }

    public function actionChangestatus(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Получаем данные из ajax запроса.
            $id_order = $_POST['id_order'];

            // Изменяем статус заказа в базе.
            App::call()->OrderRepository->cancelOrder($id_order);

            // Кодируем и делаем вывод.
            echo json_encode(['success' => 'ok', 'message' => 'заказ отменен']);
        }
    }
}