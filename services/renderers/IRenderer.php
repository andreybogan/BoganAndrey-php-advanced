<?php

namespace app\services\renderers;

interface IRenderer {
  public function render($tamplaet, $params = []);
}