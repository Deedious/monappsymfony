<?php

namespace App\Controller;

use App\Entity\Bcomments;
use App\Form\BcommentsType;
use App\Repository\BcommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bcomments')]
class BcommentsController extends AbstractController
{
    #[Route('/', name: 'app_bcomments_index', methods: ['GET'])]
    public function index(BcommentsRepository $bcommentsRepository): Response
    {
        return $this->render('bcomments/index.html.twig', [
            'bcomments' => $bcommentsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bcomments_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BcommentsRepository $bcommentsRepository): Response
    {
        $bcomment = new Bcomments();
        $form = $this->createForm(BcommentsType::class, $bcomment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcommentsRepository->save($bcomment, true);

            return $this->redirectToRoute('app_bcomments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcomments/new.html.twig', [
            'bcomment' => $bcomment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcomments_show', methods: ['GET'])]
    public function show(Bcomments $bcomment): Response
    {
        return $this->render('bcomments/show.html.twig', [
            'bcomment' => $bcomment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bcomments_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bcomments $bcomment, BcommentsRepository $bcommentsRepository): Response
    {
        $form = $this->createForm(BcommentsType::class, $bcomment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcommentsRepository->save($bcomment, true);

            return $this->redirectToRoute('app_bcomments_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcomments/edit.html.twig', [
            'bcomment' => $bcomment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcomments_delete', methods: ['POST'])]
    public function delete(Request $request, Bcomments $bcomment, BcommentsRepository $bcommentsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bcomment->getId(), $request->request->get('_token'))) {
            $bcommentsRepository->remove($bcomment, true);
        }

        return $this->redirectToRoute('app_bcomments_index', [], Response::HTTP_SEE_OTHER);
    }
}
