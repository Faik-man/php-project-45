<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use function BrainGames\Engine\gameLoop;

function calc(string $operator, int $leftOperand, int $rightOperand): int|false
{
    switch ($operator) {
        case '+':
            return $leftOperand + $rightOperand;
        case '-':
            return $leftOperand - $rightOperand;
        case '*':
            return $leftOperand * $rightOperand;
    }

    return false;
}

function run(): void
{
    $operators = [
        '+',
        '-',
        '*'
    ];

    $generatorQuestion = function () use ($operators): string {
        $lastIdxOperator = count($operators) - 1;
        $idxOperator = random_int(0, $lastIdxOperator);
        $operator = $operators[$idxOperator];

        $minNumber = 0;
        $maxNumber = 25;
        $leftOperand = random_int($minNumber, $maxNumber);
        $rightOperand = random_int($minNumber, $maxNumber);

        return "{$leftOperand} {$operator} {$rightOperand}";
    };

    $generatorCorrectAnswer = function (string $question): string {
        [$leftOperand, $operator, $rightOperand] = explode(' ', $question);

        return (string)calc($operator, (int)$leftOperand, (int)$rightOperand);
    };

    gameLoop(
        'What is the result of the expression?',
        $generatorQuestion,
        $generatorCorrectAnswer
    );
}
