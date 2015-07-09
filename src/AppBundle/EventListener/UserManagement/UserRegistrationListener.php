<?php

namespace AppBundle\EventListener\UserManagement;

use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegistrationListener implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onRegistrationInit',
        );
    }

    /**
     * When registration is initialized, set username to a unique ID.
     * @param UserEvent $event
     */
    public function onRegistrationInit(UserEvent $event)
    {
        $user = $event->getUser();
        $user->setUsername(uniqid());
    }
}