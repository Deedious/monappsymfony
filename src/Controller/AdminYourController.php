<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminYourController extends AbstractController
{
    #[Route('/admin/your', name: 'app_admin_your')]
    public function index(): Response
    {
        return $this->render('admin_your/index.html.twig', [
            'controller_name' => 'AdminYourController',
        ]);
    }
}
