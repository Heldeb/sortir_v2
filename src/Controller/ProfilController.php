<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profil(Request $request, EntityManagerInterface $entityManager): Response
    {
        //Récupération de l'utilisateur acctuellement connecté
        $user = $this->getUser();

        //Créer un formulaire basé sur la classe ProfilType et le lier à la classe Participant
        $participantForm = $this->createForm(ProfilType::class, $this->getUser());

        //Gérer la requete HTTP pour le formulaire
        $participantForm->handleRequest($request);

        //Vérifier si le formulaire a été soumis et est valide
        if($participantForm->isSubmitted()&&$participantForm->isValid()){

        //Persister les modification d el'utilisateur dans l'entityManager
            $entityManager->persist($user);
            $entityManager->flush();
            //Ajouter un message flush de succes a la session
            $this->addFlash('success','Profil modifié!Bravo');

            //Rediriger l'utilisateur vers la page sorties
            return $this->redirectToRoute('vue_sorties');

        }
        //Rend le template profil.html.twig en passant le formulaire comme variable
        return $this->render('utilisateurs/profil.html.twig', [
            'participantForm'=> $participantForm->createView()
        ]);
    }
    #[Route('/profil/{id}', name: 'app_profil_show')]
    public function show(Participant $user) :Response
    {
    return $this->render('profil/showprofil.html.twig', [
        'user'=>$user,
        ]);
    }
}
