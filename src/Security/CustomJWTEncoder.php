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
      // Récupérez les données actuelles du token
        $data = $event->getData();

        // Ajoutez les informations supplémentaires au token
        

        $data['id'] = $user->getId();
        $data['username'] = $user->getUsername();
        $data['roles'] = $user->getRoles();
        $data['email'] = $user->getEmail();

        $data['tel'] = $user->getTel();
        $data['nameBusiness'] = $user->getNameBusiness();
        $data['stats'] = $user->getStats();

        // Mettez à jour les données du token avec les nouvelles informations
        $event->setData($data);
      }  
    }

