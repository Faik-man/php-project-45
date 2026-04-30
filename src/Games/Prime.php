<?php

declare(strict_types=1);

namespace BrainGames\PrimeNumber;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';

const INPUT_VALUES_RANGE = [0, 100];

const FIRST_EVEN_DIVISOR = 2;

const FIRST_PRIME_NUMBER = 2;

const SECOND_PRIME_NUMBER = 3;

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
    if ($number < FIRST_PRIME_NUMBER) {
        return false;
    }

    if ($number === FIRST_PRIME_NUMBER) {
        return true;
    }

    if ($number % FIRST_EVEN_DIVISOR === 0) {
        return false;
    }

    for ($oddNumber = SECOND_PRIME_NUMBER; $oddNumber <= floor(sqrt($number)); $oddNumber += 2) {
        if ($number % $oddNumber === 0) {
            return false;
        }
    }

    return true;
}
