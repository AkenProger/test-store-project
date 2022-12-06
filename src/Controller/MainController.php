<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\ProductRepository;
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

    #[Route('products/', name: 'products')]
    public final function products(ProductRepository $productRepository): Response
    {
        return $this->render('main/prodcuts.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('manufacturers/', name: 'manufacturers')]
    public final function manufacturers(ManufacturerRepository $manufacturerRepository): Response
    {
        return $this->render('main/brands.html.twig', [
            'manufacturers' => $manufacturerRepository->findAll(),
        ]);
    }
}
