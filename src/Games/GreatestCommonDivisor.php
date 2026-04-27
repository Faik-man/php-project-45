<?php

declare(strict_types=1);

namespace BrainGames\GreatestCommonDivisor;

use function BrainGames\Engine\gameLoop;

function getGcd(int $firstNumber, int $secondNumber): int
{
    while ($secondNumber !== 0) {
        $rest = $firstNumber % $secondNumber;
        $firstNumber = $secondNumber;
        $secondNumber = $rest;
    }

    return $firstNumber;
}

function run(): void
{
    $generatorQuestion = function (): string {
        $minNumber = 0;
        $maxNumber = 100;
        $firstNumber = random_int($minNumber, $maxNumber);
        $secondNumber = random_int($minNumber, $maxNumber);
        return "{$firstNumber} {$secondNumber}";
    };

    $generatorCorrectAnswer = function ($numbers): string {
        [$firstNumber, $secondNumber] = array_map('intval', explode(' ', $numbers));

        return (string)getGcd($firstNumber, $secondNumber);
    };

    gameLoop(
        'Find the greatest common divisor of given numbers.',
        $generatorQuestion,
        $generatorCorrectAnswer
    );
}
