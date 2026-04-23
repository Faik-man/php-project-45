<?php

declare(strict_types=1);

namespace BrainGames\Progression;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

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
        $start = random_int(0, 100);
        $length = random_int(5, 10);
        $step = random_int(1, 10);

        $progression = createProgression($start, $length, $step);

        $idxHideElement = random_int(0, $length - 1);
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
            ? $progression[$foundIdx + 1] - $step
            : $progression[$foundIdx - 1] + $step;

        return strval($correctAnswer);
    };

    $checkerAnswer = function (string $userAnswer, string $correctAnswer): bool {
        return $correctAnswer === $userAnswer;
    };

    Engine\gameLoop(
        'What number is missing in the progression?',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
