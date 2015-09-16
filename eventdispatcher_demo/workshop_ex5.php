<?php

/*
 * Example 4: Explain the concept of Container caching.
 */

namespace Acquia\D8\Workshop;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\ContainerInterface;

require __DIR__ . '../../../vendor/autoload.php';

$cachedContainer = __DIR__.'/cached_container.php';
if (!file_exists($cachedContainer)) {
  $container = new ContainerBuilder();

  $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
  $loader->load('services.yml');

  $container->compile();

  $dump = new PhpDumper($container);
  file_put_contents(__DIR__.'/cached_container.php', $dump->dump());

}

require $cachedContainer;
$container = new \ProjectServiceContainer();
$container->get('stopwatch')->start('Build container');
$build = $container->get('stopwatch')->stop('Build container');

dump($build->getDuration() . "ms");

runApp($container);

function runApp(ContainerInterface $container) {

  $container->get('stopwatch')->start('Acquia D8 Workshop');

  // Calculate something.
  $factorial = 1;
  for ($x = 100; $x >= 1; $x--) {
    $factorial = $factorial * $x;
  }
  dump($factorial);

  $stop = $container->get('stopwatch')->stop('Acquia D8 Workshop');
  print_r($stop->getMemory() . "\n");
}
