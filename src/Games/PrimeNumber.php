<?php

declare(strict_types=1);

namespace BrainGames\PrimeNumber;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function isPrime(int $number): bool
{
    if ($number < 2) {
        return false;
    }

    if ($number === 2) {
        return true;
    }

    if ($number % 2 === 0) {
        return false;
    }

    for ($i = 3; $i <= floor(sqrt($number)); $i += 2) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}

function run(): void
{
    $generatorQuestion = function () {
        $randomNumber = random_int(0, 100);
        return $randomNumber;
    };

    $expectedAnswers = [
        'no',
        'yes'
    ];

    $generatorCorrectAnswer = function (string $number) use ($expectedAnswers): string {
        $idx = (int)isPrime((int)$number);
        $correctAnswer = $expectedAnswers[$idx];

        return strval($correctAnswer);
    };

    $checkerAnswer = function (string $userAnswer, string $correctAnswer) use ($expectedAnswers): bool {
        return in_array($userAnswer, $expectedAnswers, true) && $correctAnswer === $userAnswer;
    };

    Engine\gameLoop(
        'Answer "yes" if given number is prime. Otherwise answer "no".',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
