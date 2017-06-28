<?php
namespace Drupal\commerce_tools;

use Symfony\Component\EventDispatcher\Event;

class OrderStatePaymentEvent extends Event {
  
  const PAYMENT = 'commerce_tools.payment.details';
  protected $referenceID;
  public function __construct($referenceID)
  {
    $this->referenceID = $referenceID;
  }
  public function getReferenceID()
  {
    return $this->referenceID;
  }
  public function myEventDescription() {
    return "This is a payment details state event";
  }
}