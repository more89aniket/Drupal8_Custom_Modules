<?php

namespace Drupal\commerce_tools;

use Drupal\state_machine\Event\WorkflowTransitionEvent;

class CustomStringManipulation{

    public static function replace_mail_body($mail_body,WorkflowTransitionEvent $event)
    {
        $mail_body = str_replace("@order_id",$event->getEntity()->id(), $mail_body);
        return $mail_body;
    }

}
