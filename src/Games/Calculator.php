<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function run()
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

        $leftOperand = random_int(0, 25);
        $rightOperand = random_int(0, 25);

        $expression = "{$leftOperand} {$operator} {$rightOperand}";
        return $expression;
    };

    $generatorCorrectAnswer = function (string $question) use ($operators) {
        [$leftOperand, $operator, $rightOperand] = explode(' ', $question);

        return $operators[$operator]($leftOperand, $rightOperand);
    };

    $checkerAnswer = function ($userAnswer, $correctAnswer) {
        return $correctAnswer == $userAnswer;
    };

    Engine\gameLoop(
        'What is the result of the expression?',
        $generatorQuestion,
        $generatorCorrectAnswer,
        $checkerAnswer
    );
}
