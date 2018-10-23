<?php

namespace app\controllers;

use app\services\renderers\IRenderer;
use app\services\renderers\TemplateRenderer;

/**
 * Class Controller реализует свойства и методы общие для всех контроллеров.
 * @package app\controllers
 */
abstract class Controller {

  private $action;
  private $defaultAction = 'index';
  private $layout = "main";
  private $useLayout = true;

  private $renderer = null;

  /**
   * Controller constructor.
   * @param IRenderer $renderer
   */
  public function __construct(IRenderer $renderer) {
    $this->renderer = $renderer;
  }

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
   * Метод обертка возвращает шаблон в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
   */
  function render($template, $params = []) {
    // Получаем содержимое подшаблона в виде строки.
    $content = $this->renderTemplate($template, $params);
    // Проверяем нужно ли использовать шаблон layout.
    if ($this->useLayout) {
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