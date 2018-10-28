<?php

namespace app\controllers;

use app\services\Auth;
use app\services\renderers\IRenderer;

/**
 * Class Controller реализует свойства и методы общие для всех контроллеров.
 * @package app\controllers
 */
abstract class Controller {

  private $action;
  private $defaultAction = 'index';
  private $layout = "main";
  private $renderer = null;
  protected $auth = null;

  /**
   * Controller constructor.
   * @param IRenderer $renderer
   * @param Auth $auth
   */
  public function __construct(IRenderer $renderer, Auth $auth) {
    $this->renderer = $renderer;
    $this->auth = $auth;
  }

  // Метод запускает контроллер.
  public function run($action = null) {
    // Определяем action.
    $this->action = $action ?? $this->defaultAction;
    // Получаем полное имя action.
    $method = "action" . ucfirst($this->action);

    // Проверяем существование action, и если существует вызываем его.
    if (method_exists($this, $method)) {
      $this->$method();
    } else {
      throw new \Exception('Нет такого контроллера.');
    }
  }

  /**
   * Метод обертка возвращает шаблон в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @param bool $userLayout - Если true, то будет рендеринг в layout.
   * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
   */
  function render($template, $params = [], $userLayout =  true) {
    // Получаем содержимое подшаблона в виде строки.
    $content = $this->renderTemplate($template, $params);
    // Проверяем нужно ли использовать шаблон layout.
    if ($userLayout) {
      // Добавляем в параметры полученное содержимое подшаблона.
      $params['content'] = $content;
      // Получаем содержимое шабона в виде строки.
      $content = $this->renderTemplate("layout/{$this->layout}", $params);
    }
    // Возвращаем рузультат.
    return $content;
  }

  /**
   * Метод возвращает сгенерированный шаблон в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @return false|string Возвращаем сгенерированный шаблон в виде строки.
   */
  public function renderTemplate($template, $params = []) {
    return $this->renderer->render($template, $params);
  }
}