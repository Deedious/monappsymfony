<?php

namespace App\Controller;

use App\Entity\Bcategories;
use App\Form\BcategoriesType;
use App\Repository\BcategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bcategories')]
class BcategoriesController extends AbstractController
{
    #[Route('/', name: 'app_bcategories_index', methods: ['GET'])]
    public function index(BcategoriesRepository $bcategoriesRepository): Response
    {
        return $this->render('bcategories/index.html.twig', [
            'bcategories' => $bcategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bcategories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BcategoriesRepository $bcategoriesRepository): Response
    {
        $bcategory = new Bcategories();
        $form = $this->createForm(BcategoriesType::class, $bcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcategoriesRepository->save($bcategory, true);

            return $this->redirectToRoute('app_bcategories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcategories/new.html.twig', [
            'bcategory' => $bcategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcategories_show', methods: ['GET'])]
    public function show(Bcategories $bcategory): Response
    {
        return $this->render('bcategories/show.html.twig', [
            'bcategory' => $bcategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bcategories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bcategories $bcategory, BcategoriesRepository $bcategoriesRepository): Response
    {
        $form = $this->createForm(BcategoriesType::class, $bcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bcategoriesRepository->save($bcategory, true);

            return $this->redirectToRoute('app_bcategories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bcategories/edit.html.twig', [
            'bcategory' => $bcategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bcategories_delete', methods: ['POST'])]
    public function delete(Request $request, Bcategories $bcategory, BcategoriesRepository $bcategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bcategory->getId(), $request->request->get('_token'))) {
            $bcategoriesRepository->remove($bcategory, true);
        }

        return $this->redirectToRoute('app_bcategories_index', [], Response::HTTP_SEE_OTHER);
    }
}
