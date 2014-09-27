<?php

namespace GoBrave\Util;

class Renderer
{
  private $base_dir;
  private $type;

  public function __construct($base_dir, $type = 'html') {
    $this->base_dir = $base_dir;
    $this->type = $type;
  }

  public function render($template, $vars = [], $type = null) {
    $type     = $type ?: $this->type;
    $template = $this->findTemplate($template, $type);
    $html     = $this->renderTemplate($template, $vars);
    $html     = trim($html);
    return $html . PHP_EOL;
  }

  private function renderTemplate($template, $vars = []) {
    ob_start();
    ob_clean();
    extract($vars);
    include($template);
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
  }

  private function findTemplate($template, $type) {
    $path  = $this->base_dir;
    $path .= '/' . trim($template, '/');
    $path .= '.' . $type . '.php';

    if(!file_exists($path)) {
      throw new RendererException("Template '" . implode('.', [$template, $type, 'php']) . "' is missing");
    }

    return $path;
  }
}
