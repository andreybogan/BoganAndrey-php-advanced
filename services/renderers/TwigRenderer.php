<?php

namespace app\services\renderers;

/**
 * Class TwigRenderer
 * @package app\services\renderers
 */
class TwigRenderer implements IRenderer {

  /**
   * Метод генерирует шаблон и возвращает его в виде строки.
   * @param string $template - Имя подлключаемой страницы.
   * @param array $params - Список параметров, которые мы получаем в функции.
   * @return false|string Возвращаем сгенерированный шаблон в виде строки.
   */
  public function render($template, $params = []) {
    try {
      // Указывает, где хранятся шаблоны.
      $loader = new \Twig_Loader_Filesystem(TEMPLATE_DIR . 'twig');
      // Инициализируем Twig.
      $twig = new \Twig_Environment($loader, array(
        'cache' => '../cache',
        'auto_reload' => true
      ));
      // Передаем шаблон и параметры и возвращаем сформированное содержание.
      return $twig->render($template . ".twig", $params);
    } catch (\Exception $e) {
      exit('Ошибка: ' . $e->getMessage());
    }
  }
}