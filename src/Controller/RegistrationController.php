<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
            $data = json_decode($request->getContent(), true);
    
            $email = $data['username'] ?? null;
            $password = $data['password'] ?? null;
            $username = $data['username'] ?? null;
            $tel = $data['0666666666'] ?? null;
            
    
            if (!$email || !$password) {
                return new JsonResponse(['error' => 'Invalid data'], Response::HTTP_BAD_REQUEST);
            }
    
            $user = new User();
            $user->setEmail($email);
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);
            $user->setUserName($username);
            $user->setTel($tel);
            $user->setDateDeCreation(new \DateTime());
            $user->setImageFileName("images/profil.png");
    
            $entityManager->persist($user);
            $entityManager->flush();
    
            return new JsonResponse(['message' => 'User registered successfully'], Response::HTTP_CREATED);
        }
    }
