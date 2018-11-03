<?php

namespace app\controllers;

use app\base\App;
use app\models\entity\Basket;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller
{
    /**
     * Метод выводит html страницу каталога.
     */
    public function actionIndex()
    {
        // Получаем экземляр класса Request.
        $request = App::call()->request;
        // Получаем submit.
        $submit = $request->post('submitAddBasket') ?? null;

        // Если нажата кнопка добавить в корзину, то добавляем.
        if (isset($submit)) {
            // Добавляем товар в корзину.
            (new Basket())->addProdToBasket($this->auth->getUser()->id, $request->post('id_prod'));
            // Делаем редирект.
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Получаем объект товара.
        $model = App::call()->ProductRepository->getAll();
        // Выводим html страницу с полным описание товара.
        echo $this->render('catalog', ['model' => $model]);
    }

    /**
     * Метод выводит html страницу с полным описание товара.
     */
    public function actionCard()
    {
        // Получаем экземляр класса Request.
        $request = App::call()->request;
        // Получаем ID товара.
        $id = $request->getId();
        // Получаем submit.
        $submit = $request->post('submitAddBasket') ?? null;

        // Если нажата кнопка добавить в корзину, то добавляем.
        if (isset($submit)) {
            // Добавляем товар в корзину.
            (new Basket())->addProdToBasket($this->auth->getUser()->id, $id);
            // Делаем редирект.
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Получаем объект хранилища.
        $productRepository = App::call()->ProductRepository;
        // Получаем объект товара.
        $model = $productRepository->getOne($id);
        // Получаем массив картинок для товара.
        $modelImg = $productRepository->getProductImg($model);

        // Выводим html страницу с полным описание товара.
        echo $this->render('card',
            [
                'model' => $model,
                'modelImg' => $modelImg
            ]);
    }
}