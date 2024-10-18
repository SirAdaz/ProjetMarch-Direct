<?php

namespace App\Security;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class CustomJWTEncoder
{
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        if (!$user instanceof User) {
            return;
        }

        $data = $event->getData();

        $data['id'] = $user->getId();
        $data['roles'] = $user->getRoles();
        
        $event->setData($data);
    }
}