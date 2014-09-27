<?php

namespace GoBrave\Util;

class Renderer
{
  private static $s_templates_path;
  private static $s_type = 'html';

  private $templates_path;
  private $type;

  public static function config($config) {
    self::$s_templates_path = isset($config['templates_path']) ? $config['templates_path'] : null;
    self::$s_type           = isset($config['type']) ? $config['type'] : null;
  }

  public function __construct($templates_path = null, $type = null) {
    $this->templates_path = $templates_path ?: self::$s_templates_path;
    $this->type           = $type           ?: self::$s_type;
  }

  public function render($template, $vars = [], $type = null) {
    $type     = $type ?: $this->type;
    $template = $this->findTemplate($template, $type);
    $html     = $this->renderTemplate($template, $vars);
    $html     = trim($html);
    return $html . PHP_EOL;
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setTemplatesPath($templates_path) {
    $this->templates_path = $templates_path;
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
    $path  = $this->templates_path;
    $path .= '/' . trim($template, '/');
    $path .= '.' . $type . '.php';

    if(!file_exists($path)) {
      throw new RendererException("Template '" . implode('.', [$template, $type, 'php']) . "' is missing");
    }

    return $path;
  }
}
