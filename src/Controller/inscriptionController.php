<?php

// src/Controller/InscriptionSortieController.php

namespace App\Controller;

use App\Entity\Sortie;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class inscriptionController extends AbstractController
{
    #[Route('/sortie/inscription/{id}', name: 'inscription_sortie')]
    public function inscrireSortie(int $id, SortieRepository $sortieRepository, EntityManagerInterface $entityManager): Response
    {
        $sortie = $sortieRepository->find($id);
        $user = $this->getUser();

        if (!$sortie) {
            throw $this->createNotFoundException('La sortie n\'existe pas');
        }

        $sortie->addParticipant($user);
        $entityManager->persist($sortie);
        $entityManager->flush();

        return $this->redirectToRoute('inscription_sortie', ['id' => $id]);
    }

    #[Route('/sortie/desinscription/{id}', name: 'desinscription_sortie')]
    public function desinscrireSortie(int $id, SortieRepository $sortieRepository, EntityManagerInterface $entityManager): Response
    {
        $sortie = $sortieRepository->find($id);
        $user = $this->getUser();

        if (!$sortie) {
            throw $this->createNotFoundException('La sortie n\'existe pas');
        }

        $sortie->removeParticipant($user);
        $entityManager->persist($sortie);
        $entityManager->flush();

        return $this->redirectToRoute('sortie_detail', ['id' => $id]);
    }
}