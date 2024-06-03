<?php
// src/Controller/PresentationController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PresentationController extends AbstractController
{
    #[Route(path: '/presentation', name: 'main_presentation')]

    public function presentation(): Response
    {
        return $this->render('main/presentation.html.twig');
    }
}