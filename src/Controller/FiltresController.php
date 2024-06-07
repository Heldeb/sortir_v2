<?php

namespace App\Controller;

use App\Entity\Filtres;
use App\Form\FiltresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FiltresController extends AbstractController
{


    /* -------------------- FILTRER -------------------- */

    private $createForm;

    #[Route('/sorties/filtrer', name: 'filtrer_sorties')]

    public function filter(Request $request,
    EntityManagerInterface $entityManager): Response
    {
        $selection = new Filtres();
        $filterForm = $this->createForm(FiltresType::class, $selection);
        $filterForm->handleRequest($request);

        if ($filterForm->isSubmitted() && $filterForm->isValid()){
            $entityManager->persist($selection);
            $entityManager->flush();

            $this->addFlash('success', 'Votre choix a bien été pris en compte');
            return $this->redirectToRoute('vue_sorties'
                //, ['id' => $selection->getId()]
            );
        }

        return $this->render('sorties/filtres.html.twig', [
            'filterForm' => $filterForm->createView()
        ]);
    }

}