<?php

declare(strict_types=1);

namespace BrainGames\GreatestCommonDivisor;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

function run(): void
{
    $minNumber = 0;
    $maxNumber = 100;

    $rounds = [];
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $firstNumber = random_int($minNumber, $maxNumber);
        $secondNumber = random_int($minNumber, $maxNumber);

        $rounds[] = [
            'question'       => "{$firstNumber} {$secondNumber}",
            'correct_answer' => (string)getGcd($firstNumber, $secondNumber)
        ];
    }

    gameLoop(GAME_DESCRIPTION, $rounds);
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
