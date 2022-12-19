<?php

namespace App\Entity;

class ExampleFactory
{
    public static function create(string $rating, string $body, string $author): ExampleEntity
    {
        $example = new ExampleEntity();
        $example->setId(rand(10, 100));
        $example->setRating($rating);
        $example->setBody($body);
        $example->setAuthor($author);
        return $example;
    }

}