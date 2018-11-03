<?php

namespace app\models\entity;

use app\base\App;

/**
 * Class Basket определяет свойства и методы для работы с корзиной.
 * @package app\models
 */
class Basket extends DataEntity
{
    public $id;
    public $id_prod;
    public $id_user;
    public $amount;

    /**
     * Метод добавляет товар в корзину для текущего пользователя. Если товар с заданным ID уже есть в корзине, то
     * обновляется количество, если нет, то добавляется новый товар.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     */
    public function addProdToBasket($id_user, $id_prod)
    {
        // Вызываем объект репозитория корзины.
        $basketRepository = App::call()->basketRepository;

        // Проверяем есть ли для заданного ID товары в корзине.
        if ($basketRepository->getAmountBasketID($id_user, $id_prod) != null) {
            // Обновляем данные о количестве товаров.
            $basketRepository->updateProdToBasket($id_user, $id_prod);
        } else {
            // Добавляем товар в корзину.
            $basketRepository->insertProdToBasket($id_user, $id_prod);
        }
    }

    /**
     * Метод удаляет товар из корзины. Если в корзине только один товар с заданным ID, то товар удаляется,
     * в противном случае обновляется колечество.
     * @param int $id_user - ID пользователя.
     * @param int $id_prod - ID товара.
     */
    function removeProdFromeBasket($id_user, $id_prod)
    {
        // Вызываем объект репозитория корзины.
        $basketRepository = App::call()->basketRepository;
        // Проверяем есть ли для заданного ID товары в корзине.
        if ($basketRepository->getAmountBasketID($id_user, $id_prod)['amount'] > 1) {
            // Обновляем данные о количестве товаров.
            $basketRepository->updateProdFromBasket($id_user, $id_prod);
        } else {
            // Удаляем товар с заданым ID из корзины.
            $basketRepository->deleteProdFromBasket($id_user, $id_prod);
        }
    }

    /**
     * Если нажата кнопка Добавить, то добавляем товар в корзину.
     */
    function isSubmitAddBasket()
    {
        // Проверяем была ли нажата кнопка Добавить в корзину.
        if ($_REQUEST['submitAddBasket']) {
            // Добавляем данные в базу.
            $this->addProdToBasket(App::call()->auth->getUser()->id, App::call()->request->post('id_prod'));
            // Делаем редирект.
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }

    /**
     * Если нажата кнопка Удалить, то удаляем товар из корзины.
     */
    function isSubmitRemoveBasket()
    {
        // Проверяем была ли нажата кнопка Удалить из корзины.
        if ($_REQUEST['submitRemoveBasket']) {
            // Добавляем данные в базу.
            $this->removeProdFromeBasket(App::call()->auth->getUser()->id, App::call()->request->post('id_prod'));
            // Делаем редирект.
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }

    /**
     * Функция рассчитывает общую сумму товара в корзине.
     * @param $arrProdInBasket -  Ассоциативный массив товаров в корзине.
     * @return float|int|null - Возвращает сумму, если товара есть, и null, если товаров в корзине нет.
     */
    function getTotalPriceBasket($arrProdInBasket)
    {
        $sum = null;
        foreach ($arrProdInBasket as $value) {
            $sum += $value['price'] * $value['amount'];
        }
        return $sum;
    }
}