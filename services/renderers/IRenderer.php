<?php
/**
 * Created by PhpStorm.
 * User: ANDREY
 * Date: 22.10.2018
 * Time: 20:55
 */

namespace app\services\renderers;


interface IRenderer {
  public function render($tamplaet, $params = []);
}