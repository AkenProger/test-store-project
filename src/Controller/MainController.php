<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public final function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('categories/', name: 'categories')]
    public final function categories(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('main/categories.html.twig', [
            'categories' => $categoriesRepository->findAll(),
        ]);
    }
}
