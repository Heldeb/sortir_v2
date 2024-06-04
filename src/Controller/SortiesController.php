<?php

namespace App\Controller;

use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SortiesController extends AbstractController
{
    #[Route('/sorties', name: 'vue_sorties')]

    public function sorties(SortieRepository $sortieRepository): Response
    {
        $sorties = $sortieRepository->findBySite();

        return $this->render('sorties/sorties.html.twig', [
            'sorties' => $sorties
        ]);
    }

}
