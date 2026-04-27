<?php

declare(strict_types=1);

namespace BrainGames\CheckEven;

use function BrainGames\Engine\gameLoop;

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function run(): void
{
    $expectedAnswers = [
        'no',
        'yes'
    ];

    $generatorQuestion = function (): string {
        $randomNumber = random_int(0, 100);
        return (string)$randomNumber;
    };

    $generatorCorrectAnswer = function (string $randomNumber) use ($expectedAnswers): string {
        return $expectedAnswers[(int)isEven((int)$randomNumber)];
    };

    gameLoop(
        'Answer "yes" if the number is even, otherwise answer "no".',
        $generatorQuestion,
        $generatorCorrectAnswer
    );
}
