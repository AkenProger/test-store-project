<?php

namespace App\Services;

use App\Repository\CategoriesRepository;
use App\Repository\ManufacturerRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class ExampleServiceImpl implements ExampleService
{
    private int $rateRubPrice = 60;

    final function currencyConverter(int $rub): JsonResponse
    {
        return new JsonResponse($rub > 0 ? $rub / $this->rateRubPrice : 0);
    }

    final function getRatePrice(): JsonResponse
    {
        return new JsonResponse(array("$" => 82, "EUR" => 85, "RUB" => 1.33));
    }

    final function getAllCategories(CategoriesRepository $categoriesRepository): JsonResponse
    {
        $categories = $categoriesRepository->findAll();

        return new JsonResponse($categories != null ? $categories : array("message" => "Empty list!"));
    }

    final function getAllManufacturers(ManufacturerRepository $manufacturerRepository): JsonResponse
    {
        $manufacturers = $manufacturerRepository->findAll();
        return new JsonResponse($manufacturers != null ? $manufacturers : array("message" => "Empty list!"));
    }
}