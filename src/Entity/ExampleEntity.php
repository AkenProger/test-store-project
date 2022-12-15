<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource]
class ExampleEntity
{
    private ?int $id = null;

    public int $rating = 0;

    public string $body = '';

    public string $author = '';
}