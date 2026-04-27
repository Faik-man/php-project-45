<?php

declare(strict_types=1);

namespace BrainGames\Progression;

use function BrainGames\Engine\gameLoop;

function createProgression(int $start, int $length, int $step): array
{
    $progression = [];
    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $i * $step;
    }

    return $progression;
}

function run(): void
{
    $generatorQuestion = function (): string {
        $minStart = 0;
        $maxStart = 100;
        $start = random_int($minStart, $maxStart);

        $minLength = 5;
        $maxLength = 10;
        $length = random_int($minLength, $maxLength);

        $minStep = 1;
        $maxStep = 10;
        $step = random_int($minStep, $maxStep);

        $progression = createProgression($start, $length, $step);

        $lastIdxProgression = $length - 1;
        $idxHideElement = random_int(0, $lastIdxProgression);
        $progression[$idxHideElement] = '..';

        return implode(' ', $progression);
    };

    $generatorCorrectAnswer = function (string $question): string {
        $progression = explode(' ', $question);
        $foundIdx = (int)array_search('..', $progression, true);

        $adjacentElements = [];
        for ($i = 0, $size = count($progression); $i < $size && count($adjacentElements) <= 2; $i++) {
            if ($i === $foundIdx) {
                $adjacentElements = [];
            } else {
                $adjacentElements[] = $progression[$i];
            }
        }

        [$firstNumber, $secondNumber] = array_map('intval', $adjacentElements);
        $step = $secondNumber - $firstNumber;

        $correctAnswer = $foundIdx === 0
            ? (int)$progression[$foundIdx + 1] - $step
            : (int)$progression[$foundIdx - 1] + $step;

        return strval($correctAnswer);
    };

    $checkerAnswer = function (string $userAnswer, string $correctAnswer): bool {
        return $correctAnswer === $userAnswer;
    };

    gameLoop(
        'What number is missing in the progression?',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
