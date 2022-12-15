<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\ProductRepository;
use App\Services\ExampleServiceImpl;
use App\Services\OTPCodeGenerator;
use App\Services\RandomQuestionGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public final function index(
        CategoriesRepository   $categoriesRepository,
        ManufacturerRepository $manufacturerRepository,
        ProductRepository      $productRepository
    ): Response
    {
        return $this->render('main/index.html.twig', [
            'categories' => $categoriesRepository->findAll(),
            'brands' => $manufacturerRepository->findAll(),
            'products' => $productRepository->findAll()
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

    #[Route('converter/', name: 'converter')]
    public final function apiConverter(): JsonResponse
    {
        $money = 200;
        $exampleService = new ExampleServiceImpl();
        return $exampleService->currencyConverter($money);
    }

    #[Route('rates', name: 'rate')]
    public final function getRatePrice(): JsonResponse
    {
        $exampleService = new ExampleServiceImpl();
        return $exampleService->getRatePrice();
    }


    #[Route('category', name: 'category')]
    public final function getAllCategories(CategoriesRepository $categoriesRepository): JsonResponse
    {
        $exampleService = new ExampleServiceImpl();
        return $exampleService->getAllCategories($categoriesRepository);
    }

    #[Route('manufactures', name: 'manufacturer')]
    public final function getAllManufacturers(ManufacturerRepository $manufacturerRepository): JsonResponse
    {
        $exampleService = new ExampleServiceImpl();
        return $exampleService->getAllManufacturers($manufacturerRepository);
    }

    //Мои первый примеры использования сервисов
    #[Route('example', name: 'example')]
    public final function example(
        OTPCodeGenerator        $OTPCodeGenerator,
        RandomQuestionGenerator $randomQuestionGenerator

    ): JsonResponse
    {
        $result = array(
            "OTP code" => $OTPCodeGenerator->generate(),
            "random question" => $randomQuestionGenerator->getRandomQuestion());
        return new JsonResponse($result);
    }

    //Пример работы с файлами
    #[Route('fileExample', name: 'fileExample')]
    public final function exampleWithFile(): Response
    {
        return $this->render('main/uploadFile.html.twig');
    }

    #[Route('exampleUpload', 'exampleUp')]
    public final function exampleUploader(Request $request): void
    {
        //Тут можно отправить в сервис дял обработки
        $path = $this->getParameter('kernel.project_dir') . '/public/uploads';
        $image = $request->files->get('image');
        $image->move($path);
        dd($request);
    }

}
