<?php

// src/Controller/ProfilController.php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ProfilType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profil(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $user = $this->getUser();
        $participantForm = $this->createForm(ProfilType::class, $user);
        $participantForm->handleRequest($request);

        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
            /** @var UploadedFile $photoFile */
            $photoFile = $participantForm->get('photo')->getData();

            if ($photoFile) {
                $photoFileName = $fileUploader->upload($photoFile);
                $user->setPhoto($photoFileName);
            }

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('utilisateurs/profil.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);
    }
}