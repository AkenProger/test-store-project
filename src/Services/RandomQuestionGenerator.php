<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\JsonResponse;

class RandomQuestionGenerator
{
    private array $questions = array(
        "1" => "Что такое ООП?",
        "2" => "Что такое Java?",
        "3" => "Что такое PHP?",
        "4" => "Что такое C#?",
        "5" => "Что такое Kotlin?",
    );

    public final function getRandomQuestion(): string
    {
        return $this->questions[array_rand($this->questions)];
    }

}