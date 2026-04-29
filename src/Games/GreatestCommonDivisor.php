<?php

declare(strict_types=1);

namespace BrainGames\GreatestCommonDivisor;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ATTEMPTS;

function run(): void
{
    $minNumber = 0;
    $maxNumber = 100;
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        $firstNumber = random_int($minNumber, $maxNumber);
        $secondNumber = random_int($minNumber, $maxNumber);
        $questions[] = "{$firstNumber} {$secondNumber}";
        $correctAnswers[] = (string)getGcd($firstNumber, $secondNumber);
    }

    gameLoop([
        'Find the greatest common divisor of given numbers.',
        $questions,
        $correctAnswers
    ]);
}

function getGcd(int $firstNumber, int $secondNumber): int
{
    while ($secondNumber !== 0) {
        $rest = $firstNumber % $secondNumber;
        $firstNumber = $secondNumber;
        $secondNumber = $rest;
    }

    return $firstNumber;
}
