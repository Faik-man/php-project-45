<?php

declare(strict_types=1);

namespace BrainGames\CheckEven;

use function BrainGames\Engine\gameLoop;

function run(): void
{
    $expectedAnswers = [
        'no',
        'yes'
    ];

    $generatorQuestion = function (): string {
        $randomNumber = random_int(0, 100);
        return strval($randomNumber);
    };

    $generatorCorrectAnswer = function (string $randomNumber) use ($expectedAnswers): string {
        $isEven = ((int)$randomNumber) % 2 === 0;
        return strval($expectedAnswers[(int)$isEven]);
    };

    gameLoop(
        'Answer "yes" if the number is even, otherwise answer "no".',
        $generatorQuestion,
        $generatorCorrectAnswer
    );
}
