<?php

/**
 * Redirect event subscriber.
 */

// Declare the namespace 
namespace Drupal\eventdispatcher_demo\EventSubscriber;

// interface we implement.
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

// event to subscribe to.
use Symfony\Component\HttpKernel\KernelEvents;

// data for listener method
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

// perform a redirect if necessary.
//use Symfony\Component\HttpFoundation\RedirectResponse;

// for external redirects we use TrustedRedirectResponse
use Drupal\Core\Routing\TrustedRedirectResponse;

/**
 * Subscribe to KernelEvents::REQUEST events and redirect if site is currently
 * in maintenance mode.
 */
class RedirectSubscriber implements EventSubscriberInterface {
  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = array('checkForRedirection');
    return $events;
  }

  /**
   * This method is called whenever the KernelEvents::REQUEST event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  public function checkForRedirection(GetResponseEvent $event) {
   // If site is in maintenace mode, we can redirect to external domain
    $enabled = \Drupal::state()->get('system.maintenance_mode');
    
    if ($enabled === 1) {
      // see https://www.drupal.org/node/2532212
      $event->setResponse(new TrustedRedirectResponse('http://d7.janaksingh.com/'));
    }
  }
}