<?php

namespace app\controllers;

use app\models\Product;

/**
 * Class ProductController
 * @package app\controllers
 */
class ProductController {

  private $action;
  private $defaultAction = 'index';
  private $layout = "main";
  private $useLayout = true;

  // Метод запускает контроллер.
  public function run($action = null) {
    // Определяем action.
    $this->action = $action ?: $this->defaultAction;
    // Получаем полное имя action.
    $method = "action" . ucfirst($this->action);

    // Проверяем существование action, и если существует вызываем его.
    if (method_exists($this, $method)) {
      $this->$method();
    } else {
      echo "404";
    }
  }

  /**
   * Метод выводит html страницу каталога.
   */
  public function actionIndex() {
    // Получаем объект товара.
    $model = Product::getAll();
    // Выводим html страницу с полным описание товара.
    echo $this->render('catalog', ['model' => $model]);
  }

  /**
   * Метод выводит html страницу с полным описание товара.
   */
  public function actionCard() {
    // Получаем ID товара.
    $id = $_GET['id'];
    // Получаем объект товара.
    $model = Product::getOne($id);
    // Получаем массив картинок для товара.
    $modelImg = $model->getProductImg($id);
    // Выводим html страницу с полным описание товара.
    echo $this->render('card', ['model' => $model, 'modelImg' => $modelImg]);
  }

  /**
   * Метод обертка возвращает шаблон в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
   */
  function render($template, $params = []){
    // Получаем содержимое подшаблона в виде строки.
    $content = $this->renderTemplate($template, $params);
    // Проверяем нужно ли использовать шаблон layout.
    if($this->useLayout){
      // Добавляем в параметры полученное содержимое подшаблона.
      $params['content'] = $content;
      // Получаем содержимое шабона в виде строки.
      $content = $this->renderTemplate("layout/{$this->layout}", $params);
    }
    // Возвращаем рузультат.
    return $content;
  }
  /**
   * Метод генерирует шаблон и возвращает его в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @return false|string Возвращаем сгенерированный шаблон в виде строки.
   */
  public function renderTemplate($template, $params = []) {
    // Извлекаем переменные из массива.
    extract($params);
    // Включаем буферизацию вывода.
    ob_start();
    // Подключаем шаблон.
    require TEMPLATE_DIR . $template . ".php";
    // Возвращаем полученное содержимое текущего буфера, бефер очищаем.
    return ob_get_clean();
  }
}