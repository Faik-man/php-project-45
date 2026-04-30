<?php

declare(strict_types=1);

namespace BrainGames\PrimeNumber;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

const INPUT_VALUES_RANGE = [0, 100];

function run(): void
{
    $rounds = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $randomNumber = random_int(
            INPUT_VALUES_RANGE[0],
            INPUT_VALUES_RANGE[1]
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

    for ($i = 3; $i <= floor(sqrt($number)); $i += 2) {
        if ($number % $i === 0) {
            return false;
        }
    }

    return true;
}
