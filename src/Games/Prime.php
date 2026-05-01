<?php

declare(strict_types=1);

namespace BrainGames\PrimeNumber;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

const INPUT_VALUES_RANGE_MIN = 0;

const INPUT_VALUES_RANGE_MAX = 100;

function run(): void
{
    $rounds = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $randomNumber = random_int(
            INPUT_VALUES_RANGE_MIN,
            INPUT_VALUES_RANGE_MAX
        );

        $rounds[] = [
            'question' => (string)$randomNumber,
            'correct_answer' => isPrime($randomNumber) ? 'yes' : 'no'
        ];
    }

    gameLoop(GAME_DESCRIPTION, $rounds);
}

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

    for ($oddNumber = 3; $oddNumber <= floor(sqrt($number)); $oddNumber += 2) {
        if ($number % $oddNumber === 0) {
            return false;
        }
    }

    return true;
}
