<?php

namespace app\controllers;

use app\models\entity\Basket;
use app\models\entity\Product;
use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\services\Request;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController extends Controller {

  /**
   * Метод выводит html страницу каталога.
   */
  public function actionIndex() {
    // Получаем экземляр класса Request.
    $request = new Request();
    // Получаем submit.
    $submit = $request->post('submitAddBasket') ?? null;

    // Если нажата кнопка добавить в корзину, то добавляем.
    if (isset($submit)) {
      // Добавляем товар в корзину.
      (new BasketRepository())->addProdToBasket($this->auth->getUser()->id, $request->post('id_prod'));
      // Делаем редирект.
      header("Location: " . $_SERVER['REQUEST_URI']);
      exit;
    }

    // Получаем объект товара.
    $model = (new ProductRepository())->getAll();
    // Выводим html страницу с полным описание товара.
    echo $this->render('catalog', ['model' => $model]);
  }

  /**
   * Метод выводит html страницу с полным описание товара.
   */
  public function actionCard() {
    // Получаем экземляр класса Request.
    $request = new Request();
    // Получаем ID товара.
    $id = $request->getId();
    // Получаем submit.
    $submit = $request->post('submitAddBasket') ?? null;

    // Если нажата кнопка добавить в корзину, то добавляем.
    if (isset($submit)) {
      // Добавляем товар в корзину.
      (new BasketRepository())->addProdToBasket($this->auth->getUser()->id, $id);
      // Делаем редирект.
      header("Location: " . $_SERVER['REQUEST_URI']);
      exit;
    }

    // Получаем объект хранилища.
    $productRepository = new ProductRepository();
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