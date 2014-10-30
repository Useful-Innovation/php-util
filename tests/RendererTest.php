<?php

use GoBrave\Util\Renderer as R;

class RendererTest extends PHPUnit_Framework_Testcase
{
  public $data = __DIR__ . '/data';
  public function setUp() {
    $this->r = new R($this->data);
    $this->j = new R($this->data, 'json');
  }

  public function testRenderSpecificHtml() {
    $html = $this->r->render('template');
    $this->assertSame($html, PHP_EOL . '<h1>Template</h1>' . PHP_EOL);
  }

  public function testRenderHtmlWithVars() {
    $html = $this->r->render('vars', ['title' => 'This is vars']);
    $this->assertSame($html, PHP_EOL . '<h1>This is vars</h1>' . PHP_EOL);
  }

  public function testRenderHtmlWithCleandUpNewLines() {
    $html = $this->r->render('template_with_newlines');
    $this->assertSame($html, PHP_EOL . '<h1>Template</h1>' . PHP_EOL);
  }

  public function testRenderJson() {
    $json = $this->j->render('template', ['key' => 0]);
    $this->assertSame($json, PHP_EOL . '{' . PHP_EOL . '  "key" : 0 ' . PHP_EOL . '}' . PHP_EOL);
  }

  public function testRenderForcedType() {
    $json = $this->r->render('template', ['key' => 0], 'json');
    $this->assertSame($json, PHP_EOL . '{' . PHP_EOL . '  "key" : 0 ' . PHP_EOL . '}' . PHP_EOL);
  }

  public function testRenderFromSubDir() {
    $html = $this->r->render('sub/template_in_sub_dir');
    $this->assertSame($html, PHP_EOL . '<h1>Template in sub dir</h1>' . PHP_EOL);
  }

  public function testWithConfig() {
    R::config(['templates_path' => __DIR__ . '/data', 'type' => 'json']);
    $r = new R();
    $json = $r->render('template', ['key' => 0]);
    $this->assertSame($json, PHP_EOL . '{' . PHP_EOL . '  "key" : 0 ' . PHP_EOL . '}' . PHP_EOL);

    $r->setType('html');
    $html = $r->render('template');
    $this->assertSame($html, PHP_EOL . '<h1>Template</h1>' . PHP_EOL);

    $r->setTemplatesPath(__DIR__ . '/data/sub');
    $html = $r->render('template_in_sub_dir');
    $this->assertSame($html, PHP_EOL . '<h1>Template in sub dir</h1>' . PHP_EOL);
  }

  public function testSupportForMultipleTemplatePaths() {
    R::config([
      'templates_path' => [
        __DIR__ . '/data/sub',
        __DIR__ . '/data'
      ], 
      'type' => 'html'
    ]);

    $r = new R();
    $html = $r->render('template');
    $this->assertSame($html, PHP_EOL . '<h1>Template in sub</h1>' . PHP_EOL);
  }

  /**
   * @expectedException \GoBrave\Util\RendererException
   */
  public function testRenderMissingTemplate() {
    $this->r->render('missing_template');
  }
}
