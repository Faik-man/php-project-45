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
        line('Answer "yes" if the number is even, otherwise answer "no".');

        $randomNumber = rand(0, 100);
        return $randomNumber;
    };

    $generatorCorrectAnswer = function (int $randomNumber) use ($expectedAnswers) {
        $isEven = $randomNumber % 2 == 0;
        return $expectedAnswers[(int)$isEven];
    };

    $checkerAnswer = function ($userAnswer, $correctAnswer) use ($expectedAnswers) {
        return in_array($userAnswer, $expectedAnswers) && $correctAnswer == $userAnswer;
    };

    Engine\gameLoop(
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
