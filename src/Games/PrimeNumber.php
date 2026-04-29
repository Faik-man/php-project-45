<?php

declare(strict_types=1);

namespace BrainGames\PrimeNumber;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ATTEMPTS;

function run(): void
{
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        $randomNumber = random_int(0, 100);
        $questions[] = (string)$randomNumber;
        $correctAnswers[] = isPrime($randomNumber) ? 'yes' : 'no';
    }

    gameLoop([
        'Answer "yes" if given number is prime. Otherwise answer "no".',
        $questions,
        $correctAnswers
    ]);
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
