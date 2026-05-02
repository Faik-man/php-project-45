<?php

declare(strict_types=1);

namespace BrainGames\GreatestCommonDivisor;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';

const INPUT_VALUES_RANGE_MIN = 0;
const INPUT_VALUES_RANGE_MAX = 100;

function run(): void
{
    $rounds = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $firstNumber = random_int(
            INPUT_VALUES_RANGE_MIN,
            INPUT_VALUES_RANGE_MAX
        );

        $secondNumber = random_int(
            INPUT_VALUES_RANGE_MIN,
            INPUT_VALUES_RANGE_MAX
        );

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
