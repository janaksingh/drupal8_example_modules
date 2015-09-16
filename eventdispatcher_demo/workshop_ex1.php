<?php

/*
 * Example 1: Explain the concept of Symfony containers.
 */

namespace Acquia\D8\Workshop;

// Drupal uses its own ContainerBuilder!!!
//use Symfony\Component\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\VarDumper\VarDumper;

require __DIR__ . '../../../vendor/autoload.php';

$container = new ContainerBuilder();

$stopwatch = new Stopwatch();
$container->set('stopwatch', $stopwatch);

runApp($container);

function runApp(ContainerBuilder $container) {

  $container->get('stopwatch')->start('example1');

  // Calculate something.
  $factorial = 1;
  for ($x = 100; $x >= 1; $x--) {
    $factorial = $factorial * $x;
  }
  dump($factorial);

  $event = $container->get('stopwatch')->stop('example1');
  dump($event->getEndTime() . " ms");
}
