<?php

declare(strict_types=1);

namespace BrainGames\GreatestCommonDivisor;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

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
        [$firstNumber, $secondNumber] = explode(' ', $numbers);

        while ($secondNumber !== 0) {
            $rest = $firstNumber % $secondNumber;
            $firstNumber = $secondNumber;
            $secondNumber = $rest;
        }

        return strval($firstNumber);
    };

    $checkerAnswer = function (string $userAnswer, string $correctAnswer): bool {
        return $correctAnswer === $userAnswer;
    };

    Engine\gameLoop(
        'Find the greatest common divisor of given numbers.',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
