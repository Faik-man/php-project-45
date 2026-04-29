<?php

declare(strict_types=1);

namespace BrainGames\Progression;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ATTEMPTS;

function run(): void
{
    $minStart = 0;
    $maxStart = 100;

    $minLength = 5;
    $maxLength = 10;

    $minStep = 1;
    $maxStep = 10;

    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        $start = random_int($minStart, $maxStart);
        $length = random_int($minLength, $maxLength);
        $step = random_int($minStep, $maxStep);

        $progression = createProgression($start, $length, $step);

        $lastIdxProgression = $length - 1;
        $idxHideElement = random_int(0, $lastIdxProgression);
        $answer = $progression[$idxHideElement];
        $progression[$idxHideElement] = '..';

        $questions[] = implode(' ', $progression);
        $correctAnswers[] = (string)$answer;
    }

    gameLoop([
        'What number is missing in the progression?',
        $questions,
        $correctAnswers
    ]);
}

function createProgression(int $start, int $length, int $step): array
{
    $progression = [];
    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $i * $step;
    }

    return $progression;
}
