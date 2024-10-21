<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserImageController extends AbstractController
{
    private $entityManager;
    private $slugger;

    public function __construct(EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $this->entityManager = $entityManager;
        $this->slugger = $slugger;
    }

    #[Route('/api/users/{id}/update-image', name:'app_update_image', methods: ["POST"])]
    public function __invoke(Request $request, User $user): JsonResponse
    {
        $file = $request->files->get('imageFile');

        if ($file) {
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

            try {
                // Déplace le fichier dans le répertoire de téléchargement
                $file->move(
                    $this->getParameter('uploads_directory'),  // Répertoire de téléchargement
                    $newFilename
                );
            } catch (FileException $e) {
                return new JsonResponse(['message' => 'Erreur lors du téléchargement de l\'image'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            // Met à jour le champ imageFileName avec le nom du fichier
            $user->setImageFileName($newFilename);
            $this->entityManager->flush();

            // Retourner le nouveau nom de fichier pour le frontend
            return new JsonResponse(['imageFileName' => $newFilename], Response::HTTP_OK);
        }

        return new JsonResponse(['message' => 'Aucun fichier image fourni'], Response::HTTP_BAD_REQUEST);
    }
}
