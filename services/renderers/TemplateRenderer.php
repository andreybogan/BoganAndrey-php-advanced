<?php

namespace app\services\renderers;

/**
 * Class TemplateRenderer
 * @package app\services\renderers
 */
class TemplateRenderer implements IRenderer {

  /**
   * Метод генерирует шаблон и возвращает его в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @return false|string Возвращаем сгенерированный шаблон в виде строки.
   */
  public function render($template, $params = []) {
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