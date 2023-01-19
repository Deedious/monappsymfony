<?php

namespace App\Controller;

use App\Entity\Barticles;
use App\Entity\Bcomments;
use App\Form\BarticlesType;
use App\Repository\BarticlesRepository;
use App\Repository\BcommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/barticles')]
class BarticlesController extends AbstractController
{
    #[Route('/', name: 'app_barticles_index', methods: ['GET'])]
    public function index(BarticlesRepository $barticlesRepository): Response
    {
        return $this->render('barticles/index.html.twig', [
            'barticles' => $barticlesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_barticles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BarticlesRepository $barticlesRepository, BcommentsRepository $bcommentsRepository): Response
    {


         $barticle = new Barticles();
        $form = $this->createForm(BarticlesType::class, $barticle);
        $bcomments = new Bcomments();
        $form = $this->createForm(Bcommentaire1Type::class, $bcomments);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barticlesRepository->save($barticle, true);

            return $this->redirectToRoute('app_barticles_index',[], Response::HTTP_SEE_OTHER);
        }

        // Récupérer tous les commentaires correspondants a l'identifiant de l'URL
       // $comments=$bcommentsRepository->findBy(['barticles' => $barticles->getId()]);
        return $this->renderForm('barticles/show2.html.twig', [
            'barticles' => $barticle,
            //'comment' => $comments,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barticles_show', methods: ['GET'])]
    public function show(Barticles $barticle): Response
    {
        return $this->render('barticles/show.html.twig', [
            'barticle' => $barticle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_barticles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Barticles $barticle, BarticlesRepository $barticlesRepository): Response
    {
        $form = $this->createForm(BarticlesType::class, $barticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barticlesRepository->save($barticle, true);

            return $this->redirectToRoute('app_barticles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('barticles/edit.html.twig', [
            'barticle' => $barticle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_barticles_delete', methods: ['POST'])]
    public function delete(Request $request, Barticles $barticle, BarticlesRepository $barticlesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barticle->getId(), $request->request->get('_token'))) {
            $barticlesRepository->remove($barticle, true);
        }

        return $this->redirectToRoute('app_barticles_index', [], Response::HTTP_SEE_OTHER);
    }
}
