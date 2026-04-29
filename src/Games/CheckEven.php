<?php

declare(strict_types=1);

namespace BrainGames\CheckEven;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ATTEMPTS;

function run(): void
{
    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        $randomNumber = random_int(0, 100);
        $questions[] = $randomNumber;
        $correctAnswers[] = isEven($randomNumber) ? 'yes' : 'no';
    }

    gameLoop([
        'Answer "yes" if the number is even, otherwise answer "no".',
        $questions,
        $correctAnswers
    ]);
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}
