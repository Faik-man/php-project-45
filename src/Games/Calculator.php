<?php

declare(strict_types=1);

namespace BrainGames\Calculator;

use function cli\line;
use function cli\prompt;

function run()
{
    line("Welcome to the Brain Game!");

    $name = prompt("May I have your name?", false, ' ');
    line("Hello, %s!", $name);

    line('What is the result of the expression?');

    $operators = [
        '+' => fn ($a, $b) => $a + $b,
        '-' => fn ($a, $b) => $a - $b,
        '*' => fn ($a, $b) => $a * $b,
    ];

    $countAttempts = 3;
    $lastIdxOperator = count($operators) - 1;

    for ($i = 0; $i < $countAttempts; $i++) {
        $idxOperator = rand(0, $lastIdxOperator);
        $operator = array_keys($operators)[$idxOperator];

        $leftOperand = rand(0, 25);
        $rightOperand = rand(0, 25);

        $expression = "{$leftOperand} {$operator} {$rightOperand}";
        line('Question: %s', $expression);

        $answer = prompt("Your answer");

        $correctAnswer = $operators[$operator]($leftOperand, $rightOperand);
        if ($correctAnswer != $answer) {
            line(
                "'%s' is wrong answer ;(. Correct answer was '%s'.",
                $answer,
                $correctAnswer);

            line("Let's try again, %s!", $name);
            return;
        }

        line("Correct!");
    }

    line("Congratulations, %s!", $name);
}
