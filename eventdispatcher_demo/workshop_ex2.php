<?php

/*
 * Example 2: Explain the concept of Definition.
 */

namespace Acquia\D8\Workshop;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Stopwatch\Stopwatch;

require __DIR__ . '../../../vendor/autoload.php';

$container = new ContainerBuilder();

// Simple example without any parameters.
$loggerDefinition = new Definition('Symfony\Component\Stopwatch\Stopwatch');
$container->setDefinition('stopwatch', $loggerDefinition);
// At this point the container knows 'how' to create the StopWatch service.

runApp($container);

function runApp(ContainerBuilder $container) {

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
