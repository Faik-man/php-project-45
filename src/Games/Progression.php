<?php

declare(strict_types=1);

namespace BrainGames\Progression;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'What number is missing in the progression?';

const START_VALUES_RANGE = [0, 100];

const LENGTH_VALUES_RANGE = [5, 10];

const STEP_VALUES_RANGE = [1, 10];

const PROGRESSION_FIRST_INDEX = 0;

function run(): void
{
    $rounds = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $start = random_int(
            START_VALUES_RANGE[0],
            START_VALUES_RANGE[1]
        );

        $length = random_int(
            LENGTH_VALUES_RANGE[0],
            LENGTH_VALUES_RANGE[1]
        );

        $step = random_int(
            STEP_VALUES_RANGE[0],
            STEP_VALUES_RANGE[1]
        );

        $progression = createProgression($start, $length, $step);

        $lastIdxProgression = $length - 1;
        $idxHideElement = random_int(PROGRESSION_FIRST_INDEX, $lastIdxProgression);
        $answer = $progression[$idxHideElement];
        $progression[$idxHideElement] = '..';

        $rounds[] = [
            'question'       => implode(' ', $progression),
            'correct_answer' => (string)$answer
        ];
    }

    gameLoop(GAME_DESCRIPTION, $rounds);
}

function createProgression(int $start, int $length, int $step): array
{
    $progression = [];
    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $i * $step;
    }

    return $progression;
}
