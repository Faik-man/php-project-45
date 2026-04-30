<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'What is the result of the expression?';

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
    $rounds = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $idxOperator = random_int(0, $lastIdxOperator);
        $operator = $operators[$idxOperator];

        $leftOperand = random_int($minNumber, $maxNumber);
        $rightOperand = random_int($minNumber, $maxNumber);

        $rounds[] = [
            'question'       => "{$leftOperand} {$operator} {$rightOperand}",
            'correct_answer' => (string)calc($operator, $leftOperand, $rightOperand)
        ];
    }

    gameLoop(GAME_DESCRIPTION, $rounds);
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
