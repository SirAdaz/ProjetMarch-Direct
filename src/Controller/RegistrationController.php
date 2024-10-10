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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['POST'])]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $passwordHasher, 
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
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

        // Envoi d'un email à l'utilisateur
        $emailMessage = (new Email())
            ->from('elyayusd@gmail.com') // Boîte d'envoi
            ->to($user->getEmail()) // Envoi de l'email à l'utilisateur enregistré
            ->subject('Bienvenue sur Marché Direct !')
            ->text('Bonjour '.$username .', profitez de tous vos produits préférés.')
            ->html('<p>Merci de vous être inscrit sur notre site !</p>');

        $mailer->send($emailMessage);

        return new JsonResponse(['message' => 'User registered successfully'], Response::HTTP_CREATED);

    }
}