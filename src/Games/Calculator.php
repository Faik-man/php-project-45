<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ATTEMPTS;

function run(): void
{
    $operators = [
        '+',
        '-',
        '*'
    ];

    $lastIdxOperator = count($operators) - 1;
    $minNumber = 0;
    $maxNumber = 25;

    $questions = [];
    $correctAnswers = [];
    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        $idxOperator = random_int(0, $lastIdxOperator);
        $operator = $operators[$idxOperator];

        $leftOperand = random_int($minNumber, $maxNumber);
        $rightOperand = random_int($minNumber, $maxNumber);

        $questions[] = "{$leftOperand} {$operator} {$rightOperand}";
        $correctAnswers[] = (string)calc($operator, $leftOperand, $rightOperand);
    }

    gameLoop([
        'What is the result of the expression?',
        $questions,
        $correctAnswers,
    ]);
}

function calc(string $operator, int $leftOperand, int $rightOperand): int|false
{
    $result = false;
    switch ($operator) {
        case '+':
            $result = $leftOperand + $rightOperand;
            break;
        case '-':
            $result = $leftOperand - $rightOperand;
            break;
        case '*':
            $result = $leftOperand * $rightOperand;
            break;
        default:
            break;
    }

    return $result;
}
