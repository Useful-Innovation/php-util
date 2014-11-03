<?php

namespace GoBrave\Util;

class Renderer
{
  private static $s_templates_path;
  private static $s_type = 'html';

  private $templates_paths;
  private $type;

  public static function config($config) {
    if(isset($config['templates_path'])) {
      if(is_array($config['templates_path'])) {
        self::$s_templates_path = $config['templates_path'];
      } else {
        self::$s_templates_path = [$config['templates_path']];
      }
    }
    self::$s_type = isset($config['type']) ? $config['type'] : null;
  }

  public function __construct($templates_paths = null, $type = null) {
    $this->setTemplatesPath($templates_paths ?: self::$s_templates_path);
    $this->setType($type ?: self::$s_type);
  }

  public function render($template, $vars = [], $type = null) {
    $type     = $type ?: $this->type;
    $template = $this->findTemplate($template, $type);
    $output   = $this->renderTemplate($template, $vars);
    $output   = trim($output);
    return $output . PHP_EOL;
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function setTemplatesPath($templates_paths) {
    if(is_array($templates_paths)) {
      $this->templates_paths = $templates_paths;
    } else {
      $this->templates_paths = [$templates_paths];
    }
  }

  private function renderTemplate($template, $vars = []) {
    ob_start();
    ob_clean();
    extract($vars);
    include($template);
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
  }

  private function findTemplate($template, $type) {
    $template_path = false;
    foreach($this->templates_paths as $path) {
      $path .= '/' . trim($template, '/');
      $path .= '.' . $type . '.php';
      if(file_exists($path)) {
        $template_path = $path;
        break;
      }
    }

    if($template_path === false) {
      throw new RendererException("Template '" . implode('.', [$template, $type, 'php']) . "' is missing");
    }

    return $template_path;
  }
}
