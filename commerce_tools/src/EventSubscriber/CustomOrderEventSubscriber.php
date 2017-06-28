<?php

namespace Drupal\commerce_tools\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\state_machine\Event\WorkflowTransitionEvent;
use Drupal\commerce_tools\CustomStringManipulation;


/**
 * Class CustomOrderEventSubscriber.
 *
 * @package Drupal\commerce_tools
 */
class CustomOrderEventSubscriber implements EventSubscriberInterface {


  /**
   * Constructs a new CustomOrderEventSubscriber object.
   */
  public function __construct() {

  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    //$events['commerce_order.fulfill.pre_transition'] = ['onFulfillTransition'];
    $events['commerce_order.fulfill.post_transition'] = ['onPostFulfillTransition'];
    $events['commerce_order.validate.pre_transition'] = ['onPreValidateTransition'];
    //$events['commerce_order.payment.pre_transition'] = ['onPrePaymentTransition'];
    //$events['commerce_order.paidamount.pre_transition'] = ['onPaymentTransition'];
    $events['commerce_order.paymentack.pre_transition'] = ['onPaymentAckTransition'];
    $events['commerce_order.dispatch.pre_transition'] = ['onDispatchTransition'];
    return $events;
  }

  /**
   * This method is called whenever the commerce_order.fulfill.pre_transition event is
   * dispatched.
   *
   * @param GetResponseEvent $event
   */
  // public function onFulfillTransition(Event $event) {
  //   $order = $event->getOrder();
  //   print_r($order);
  //   drupal_set_message('Event commerce_order.fulfill.pre_transition thrown by Subscriber in module commerce_tools.', 'status', TRUE);
  // }

  public function onPreValidateTransition(WorkflowTransitionEvent $event){
       $order = $event->getEntity();
    /* Getting Values from configuration form */
       $mail_body = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('amount_mail_body');
       $mailManager = \Drupal::service('plugin.manager.mail');
       $module = 'commerce_tools';
       $key = 'order_status';
       $to = $order->get('mail')->getValue()[0]['value'];
       $params['message'] = CustomStringManipulation::replace_mail_body($mail_body,$event);
       $params['subject'] = $subject = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('amount_subject');
       $langcode = 'ja';
       $send = true;
       $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);
     drupal_set_message('Event commerce_order.validate.pre_transition thrown by Subscriber in module commerce_tools.', 'status', TRUE);
  }

  public function onPaymentAckTransition(WorkflowTransitionEvent $event){

    $order = $event->getEntity();
    /* Getting Values from configuration form */
       $mail_body = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('mail_body');
       $mailManager = \Drupal::service('plugin.manager.mail');
       $module = 'commerce_tools';
       $key = 'order_status';
       $to = $order->get('mail')->getValue()[0]['value'];
       $params['message'] = CustomStringManipulation::replace_mail_body($mail_body,$event);
       $params['subject'] = $subject = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('subject');
       $langcode = 'ja';
       $send = true;
       $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    drupal_set_message('Event commerce_order.paymentack.pre_transition thrown by Subscriber in module commerce_tools.', 'status', TRUE);
  }

  public function onPostFulfillTransition(WorkflowTransitionEvent $event){
     $order = $event->getEntity();

      /* Getting Values from configuration form */
       //$mail_body = \Drupal::service('config.factory')->getEditable('mail_body');
      $mail_body = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('order_process_mail_body');
       $mailManager = \Drupal::service('plugin.manager.mail');
       $module = 'commerce_tools';
       $key = 'order_status';
       $to = $order->get('mail')->getValue()[0]['value'];
       $params['message'] = CustomStringManipulation::replace_mail_body($mail_body,$event);
       $params['subject'] = $subject = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('order_process_subject');
       $langcode = 'ja';
       $send = true;
       $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    drupal_set_message('Event commerce_order.fulfill.post_transition thrown by Subscriber in module commerce_tools.', 'status', TRUE);
  }

  public function onDispatchTransition(WorkflowTransitionEvent $event){
    $order = $event->getEntity();
    $mail_body = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('order_dispatched_mail_body');
       $mailManager = \Drupal::service('plugin.manager.mail');
       $module = 'commerce_tools';
       $key = 'order_status';
       $to = $order->get('mail')->getValue()[0]['value'];
       $params['message'] = CustomStringManipulation::replace_mail_body($mail_body,$event);
       $params['subject'] = $subject = \Drupal::service('config.factory')->getEditable('commerce_tools.orderstatemailtemplate')->get('order_dispatched_subject');
       $langcode = 'ja';
       $send = true;
       $result = $mailManager->mail($module, $key, $to, $langcode, $params, NULL, $send);

    drupal_set_message('Event commerce_order.dispatch.pre_transition thrown by Subscriber in module commerce_tools.', 'status', TRUE);
  }


}
