<?php

namespace app\models\entity;

use app\base\App;

/**
 * Class Order определяет свойства и методы для работы с заказами.
 * @package app\models\entity
 */
class Order extends DataEntity
{
    public $id_order;
    public $id_user;
    public $date;
    public $address;
    public $status;
    public $total;

    /**
     * Если была нажата кнопка Заказать, то формируется заказа и добавляется в базу.
     */
    public function isSubmitAddOrder()
    {
        // Получаем объект Request.
        $request = App::call()->request;
        // Получаем id пользователя.
        $id = App::call()->auth->getUser()->id;

        // Проверяем была ли нажата кнопка Удалить из корзины.
        if ($request->post('submitAddOrder')) {
            // Получаем данные из формы.
            $totalPriceBasket = $request->post('totalPriceBasket');
            $address = $request->post('address');

            // Получаем массив товаров в корзине.
            $arrAllProdBasket = App::call()->BasketRepository->getAllBasket($id);

            // Получаем текущее время.
            $time = time();

            // Добавляем данные заказа в таблицу orders.
            App::call()->OrderRepository->addOrder($id, $time, $address, $totalPriceBasket);


            // Получаем id добавленного заказа.
            $lastInsertId = App::call()->db->lastInsertId();

            App::call()->OrderRepository->addOrderItems($arrAllProdBasket, $lastInsertId);

            // Очищаем корзину.
            App::call()->BasketRepository->cleanBasket($id);

            // Делаем редирект.
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
}