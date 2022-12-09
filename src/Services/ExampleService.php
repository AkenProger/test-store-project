<?php

namespace App\Services;

use App\Repository\CategoriesRepository;
use App\Repository\ManufacturerRepository;
use http\Env\Response;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\JsonResponse;

interface ExampleService
{
    function currencyConverter(int $rub): JsonResponse;

    function getRatePrice(): JsonResponse;

    function getAllCategories(CategoriesRepository $categoriesRepository): JsonResponse;

    function getAllManufacturers(ManufacturerRepository $manufacturerRepository): JsonResponse;
}