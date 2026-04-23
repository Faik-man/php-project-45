<?php

declare(strict_types=1);

namespace BrainGames\GreatestCommonDivisor;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function run(): void
{
    $generatorQuestion = function (): string {
        $firstNumber = random_int(0, 100);
        $secondNumber = random_int(0, 100);
        return "{$firstNumber} {$secondNumber}";
    };

    $generatorCorrectAnswer = function ($numbers) {
        [$firstNumber, $secondNumber] = explode(' ', $numbers);
        $min = min($firstNumber, $secondNumber);

        while ($secondNumber != 0) {
            $rest = $firstNumber % $secondNumber;
            $firstNumber = $secondNumber;
            $secondNumber = $rest;
        }

        return $firstNumber;
    };

    $checkerAnswer = function ($userAnswer, $correctAnswer) {
        return $correctAnswer == $userAnswer;
    };

    Engine\gameLoop(
        'Find the greatest common divisor of given numbers.',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
