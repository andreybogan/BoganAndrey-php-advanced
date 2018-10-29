<?php

namespace app\services\renderers;

/**
 * Interface IRenderer
 * @package app\services\renderers
 */
interface IRenderer
{
    // Метод генерирует шаблон и возвращает его в виде строки.
    public function render($tamplaet, $params = []);
}