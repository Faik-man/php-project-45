<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use function BrainGames\Engine\gameLoop;

use const BrainGames\Engine\MAX_ROUNDS;

const GAME_DESCRIPTION = 'What is the result of the expression?';

const INPUT_VALUES_RANGE_MIN = 0;

const INPUT_VALUES_RANGE_MAX = 25;

const OPERATORS_FIRST_INDEX = 0;

function run(): void
{
    $operators = [
        '+',
        '-',
        '*'
    ];

    $lastIdxOperator = count($operators) - 1;

    $rounds = [];
    for ($i = 0; $i < MAX_ROUNDS; $i++) {
        $idxOperator = random_int(OPERATORS_FIRST_INDEX, $lastIdxOperator);
        $operator = $operators[$idxOperator];

        $leftOperand = random_int(
            INPUT_VALUES_RANGE_MIN,
            INPUT_VALUES_RANGE_MAX
        );

        $rightOperand = random_int(
            INPUT_VALUES_RANGE_MIN,
            INPUT_VALUES_RANGE_MAX
        );

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
            die("Ошибка: используется неопределенная математическая операция!");
            break;
    }

    return $result;
}
