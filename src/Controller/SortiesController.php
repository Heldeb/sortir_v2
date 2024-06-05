<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Form\SortieType;
use App\Repository\EtatRepository;
use App\Repository\LieuRepository;
use App\Repository\ParticipantRepository;
use App\Repository\SiteRepository;
use App\Repository\SortieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SortiesController extends AbstractController
{
    #[Route('/sorties', name: 'vue_sorties')]
    public function sorties(SortieRepository $sortieRepository): Response
    {
        $sorties = $sortieRepository->findAll();

        return $this->render('sorties/sorties.html.twig', [
            'sorties' => $sorties
        ]);
    }

    #[Route('/sorties/create', name: 'creation_sorties')]
    public function creation(Request                $request,
                             EntityManagerInterface $entityManager,
                             LieuRepository         $lieuRepository,
                             SiteRepository         $siteRepository,
                             ParticipantRepository  $participantRepository,
                             EtatRepository $etatRepository): Response
    {
        $sortie = new Sortie();

        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);

        if ($sortieForm->isSubmitted() && $sortieForm->isValid()) {
            $sortie->setLieu($lieuRepository ->find($sortie->getLieu()-> getId()));
            $sortie->setEtat($etatRepository ->find($sortie->getEtat()->getId()));


            $entityManager->persist($sortie);
            $entityManager->flush();

            $this->addFlash('success', 'Sortie créé !');
            return $this->redirectToRoute('vue_sorties');
        }
        return $this->render('sorties/create.html.twig', [
            'sortieForm' => $sortieForm->createView()
        ]);

    }


    private function getDoctrine()
    {
    }
}

