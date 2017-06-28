<?php

namespace Drupal\commerce_tools\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class OrderStateMailTemplate.
 *
 * @package Drupal\commerce_tools\Form
 */
class OrderStateMailTemplate extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'commerce_tools.orderstatemailtemplate',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'order_state_mail_template';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('commerce_tools.orderstatemailtemplate');
    
    /* Mail template for Amount Confirmation */
    
    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Subject'),
      '#description' => $this->t('Mail Subject'),
      '#default_value' => $config->get('subject'),
    ];
    $form['mail_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Mail Body'),
      '#description' => $this->t('Mail Template Body - Holds actual mail content'),
      '#default_value' => $config->get('mail_body'),
    ];

    /* Mail template for Amount Received */
    
    $form['amount_subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Amount Received Confirmation - Subject'),
      '#description' => $this->t('Mail Subject'),
      '#default_value' => $config->get('amount_subject'),
    ];
    $form['amount_mail_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Amount Received Confirmation - Mail Body'),
      '#description' => $this->t('Mail Template Body - Holds actual mail content'),
      '#default_value' => $config->get('amount_mail_body'),
    ];

    /* Mail Template for Order in Process */
    
    $form['order_process_subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Order in Process - Subject'),
      '#description' => $this->t('Mail Subject'),
      '#default_value' => $config->get('order_process_subject'),
    ];
    $form['order_process_mail_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Order in Process - Mail Body'),
      '#description' => $this->t('Mail Template Body - Holds actual mail content'),
      '#default_value' => $config->get('order_process_mail_body'),
    ];

    /* Mail Template for Order Dispatched */
    
    $form['order_dispatched_subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Order Dispatched - Subject'),
      '#description' => $this->t('Mail Subject'),
      '#default_value' => $config->get('order_dispatched_subject'),
    ];
    $form['order_dispatched_mail_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Order Dispatched - Mail Body'),
      '#description' => $this->t('Mail Template Body - Holds actual mail content'),
      '#default_value' => $config->get('order_dispatched_mail_body'),
    ];

    /* Mail Template for Order Received */
    
    $form['order_received_subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Order Received - Subject'),
      '#description' => $this->t('Mail Subject'),
      '#default_value' => $config->get('order_received_subject'),
    ];
    $form['order_received_mail_body'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Order Received - Mail Body'),
      '#description' => $this->t('Mail Template Body - Holds actual mail content'),
      '#default_value' => $config->get('order_received_mail_body'),
    ];
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('commerce_tools.orderstatemailtemplate')
      ->set('mail_body', $form_state->getValue('mail_body'))
      ->set('subject', $form_state->getValue('subject'))
      ->set('amount_mail_body', $form_state->getValue('amount_mail_body'))
      ->set('amount_subject', $form_state->getValue('amount_subject'))
      ->set('order_process_mail_body', $form_state->getValue('order_process_mail_body'))
      ->set('order_process_subject', $form_state->getValue('order_process_subject'))
      ->set('order_dispatched_mail_body', $form_state->getValue('order_dispatched_mail_body'))
      ->set('order_dispatched_subject', $form_state->getValue('order_dispatched_subject'))
      ->set('order_received_mail_body', $form_state->getValue('order_received_mail_body'))
      ->set('order_received_subject', $form_state->getValue('order_received_subject'))
      ->save();
  }

}
