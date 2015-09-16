<?php

/*
 * Example 3: Explain the concept of Containers and the power of YAML.
 */

namespace Acquia\D8\Workshop;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

require __DIR__ . '../../../vendor/autoload.php';

$container = new ContainerBuilder();

dump(__DIR__.'/config' . "\n");
$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
$loader->load('services.yml');

/* Lets move this Service definition to a YAML file.
// Simple example without any parameters.
$loggerDefinition = new Definition('Symfony\Component\Stopwatch\Stopwatch');
$container->setDefinition('stopwatch', $loggerDefinition);
// At this point the container knows 'how' to create the StopWatch service.
*/

runApp($container);

function runApp(ContainerBuilder $container) {

  $container->get('stopwatch')->start('Acquia D8 Workshop');

  // Calculate.
  // Calculate something.
  $factorial = 1;
  for ($x = 100; $x >= 1; $x--) {
    $factorial = $factorial * $x;
  }
  dump($factorial);

  $stop = $container->get('stopwatch')->stop('Acquia D8 Workshop');
  print_r($stop->getMemory() . "\n");
}
