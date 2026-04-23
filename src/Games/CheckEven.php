<?php

declare(strict_types=1);

namespace BrainGames\CheckEven;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function run(): void
{
    $expectedAnswers = [
        'no',
        'yes'
    ];

    $generatorQuestion = function () {
        $randomNumber = random_int(0, 100);
        return $randomNumber;
    };

    $generatorCorrectAnswer = function (string $randomNumber) use ($expectedAnswers): string {
        $isEven = ((int)$randomNumber) % 2 === 0;
        return strval($expectedAnswers[(int)$isEven]);
    };

    $checkerAnswer = function (string $userAnswer, string $correctAnswer) use ($expectedAnswers): bool {
        return in_array($userAnswer, $expectedAnswers, true) && $correctAnswer === $userAnswer;
    };

    Engine\gameLoop(
        'Answer "yes" if the number is even, otherwise answer "no".',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
