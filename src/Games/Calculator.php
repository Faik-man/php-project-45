<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use function BrainGames\Engine\gameLoop;

function run(): void
{
    $operators = [
        '+' => fn ($a, $b) => $a + $b,
        '-' => fn ($a, $b) => $a - $b,
        '*' => fn ($a, $b) => $a * $b,
    ];

    $generatorQuestion = function () use ($operators): string {
        $lastIdxOperator = count($operators) - 1;
        $idxOperator = random_int(0, $lastIdxOperator);
        $operator = array_keys($operators)[$idxOperator];

        $minNumber = 0;
        $maxNumber = 25;
        $leftOperand = random_int($minNumber, $maxNumber);
        $rightOperand = random_int($minNumber, $maxNumber);

        return "{$leftOperand} {$operator} {$rightOperand}";
    };

    $generatorCorrectAnswer = function (string $question) use ($operators): string {
        [$leftOperand, $operator, $rightOperand] = explode(' ', $question);

        return strval($operators[$operator]($leftOperand, $rightOperand));
    };

    $checkerAnswer = function (string $userAnswer, string $correctAnswer) {
        return $correctAnswer === $userAnswer;
    };

    gameLoop(
        'What is the result of the expression?',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
