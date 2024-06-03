<?php

namespace App\Controller;

use App\Repository\SortiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/sorties', name: 'sortie_')]

class SortiesController extends AbstractController
{
    #[Route('', name: 'list')]

    public function list(SortieRepository $sortieRepository): Response
    {
        $sorties = $sortieRepository->findAll();

        return $this->render('sorties.html.twig', [
            'sorties' => $sorties
        ]);
    }
}
