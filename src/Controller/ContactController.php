<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $formulaire = $this->createForm(ContactType::class);

        // traitement de l'envoie du formulaire :
        //1. regarder à partir du formulaire
        // si des données sont à lire dans l'objet request
       $formulaire->handleRequest($request);
       // 2. Si je trouve des données et que le formulaire
       // on a cliqué sur envoyé
       if ($formulaire->isSubmitted() && $formulaire->isValid()) {
           // $form->getData() holds the submitted values
           // but, the original $task variable has also been updated
           $task = $formulaire->getData();

           // ... perform some action, such as saving the task to the database

           return $this->render('contact/contact_envoye.html.twig', [
            'data' => $task
        ]);
       }
        $niveau_eleve = "nul de ouf bof tranquille ca va";
        return $this->renderForm('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'prenom => Undercover',
            'nom => Brother',
            'niveau_eleve' => $niveau_eleve,
            'formulaire'=>$formulaire ,
        ]);
    }
}
