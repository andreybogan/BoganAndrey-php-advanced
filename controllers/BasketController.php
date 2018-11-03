<?php

namespace app\controllers;

use app\base\App;
use app\models\entity\Basket;

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
        $id = App::call()->auth->getUser()->id;

        // Получаем объект Basket.
        $basket = new Basket();

        // Если нажата кнопка Добавить, то добавляем товар в корзину.
        $basket->isSubmitAddBasket();

        // Если нажата кнопка Удалить, то удаляем товар из корзины.
        $basket->isSubmitRemoveBasket();

        // Получаем объект товара.
        $model = App::call()->BasketRepository->getAllBasket($id);

        // Получаем общую сумму товаров в корзине.
        $totalSum = $basket->getTotalPriceBasket($model);

        // Выводим html страницу с полным описание товара.
        echo $this->render('basket', ['model' => $model, 'totalSum' => $totalSum]);
    }
}