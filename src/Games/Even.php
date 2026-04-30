<?php

declare(strict_types=1);

namespace BrainGames\CheckEven;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';

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
            'question'       => $randomNumber,
            'correct_answer' => isEven($randomNumber) ? 'yes' : 'no'
        ];
    }

    gameLoop(GAME_DESCRIPTION, $rounds);
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}
