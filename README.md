# GoBrave Utilities package

This is a package with common classes to use in a PHP environment. 

## Installation

Install with [Composer](http://getcomposer.org) by adding this to your `composer.json` file.

    "require": {
      "gobrave/util" : "~1.4.1"
    },
    "repositories" : [
      {
        "type" : "composer",
        "url"  : "http://satis.goingbrave.se"
      }
    ]

## Classes

### Collection

A collection class.

**Example**

    $array_of_objects = [....];
    $posts = new \GoBrave\Util\Collection($array_of_objects, 'ID'); // Sets the comparing key to ID

    isset($posts[152]); // Does a post with $post->ID == 152 exists?
    unset($posts[152]); // Unset the post with ID == 152

    foreach($posts as $index => $post) {
      // index == the index, not the post-ID
    }

    $posts->length();   // A wrapper for count($array)
    $posts->toArray();  // Returns the original array

#### WP / IWP
A class and interface to use in Wordpress in order to make all the global functions mockable in tests. By using the `WP` object when calling all global Wordpress functions you can inject a fake `WP` object in your tests.

**Example**

    class Something
    {
      public function __construct(\GoBrave\Util\IWP $wp) {
        $wp->add_action('init', function() {
          // Do something
        });
      }
    }

### Renderer

A class that renders templates with local variables.

    // in path/to/templates/product_template.html.php
    <h1><?= $product->title; ?></h1>

    // index.php
    $renderer = new \GoBrave\Util\Renderer('path/to/templates', 'html');
    $html     = $renderer->render('product_template', ['product' => Product::find(5) ]);

    $html == '<h1>' . Product::find(5)->title . '</h1>' . PHP_EOL; // true

### Singleton

A class that forces the user to only have one instance.

    new \GoBrave\Util\Singleton(); // Fatal error

    class Example extends \GoBrave\Util\Singleton {}

    new Example(); // Fatal error
    $c1 = Example::get();
    $c1 instanceof \GoBrave\Util\Singleton; // true
    $c2 = Example::get();
    $c1 === $c2; // true

### Printer

A class to print messages to the console in pretty colors

    $echo_mode = true; // Default true. Will echo instead of return
    $printer = new GoBrave\Util\Printer($echo_mode);
    $printer->info('some info');        // Will be printer in cyan
    $printer->success('some succes');   // Will be printed in green
    $printer->warning('some warning');  // Will be printed in yellow
    $printer->error('some error');      // Will be printed in red
    $printer->plain('some text');       // Will be printed regularly

The second parameter of all the above methods (`info`, `success`, `warning`, `error`, `plain`) got a second parameter for adding a new line to the message. It defaults to true.

    // Turn of auto echo
    $printer->setEchoMode(false);

