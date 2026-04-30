<?php

declare(strict_types=1);

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const MAX_ROUNDS = 3;

function gameLoop(
    string $description,
    array $rounds
): void {

    line("Welcome to the Brain Games!");

    $name = prompt("May I have your name?", false, ' ');
    line("Hello, %s!", $name);

    line($description);

    foreach ($rounds as ['question' => $question, 'correct_answer' => $correctAnswer]) {
        line('Question: %s', $question);

        $userAnswer = prompt("Your answer");
        if ($correctAnswer !== $userAnswer) {
            line(
                "'%s' is wrong answer ;(. Correct answer was '%s'.",
                $userAnswer,
                $correctAnswer
            );

            line("Let's try again, %s!", $name);
            return;
        }

        line("Correct!");
    }

    line("Congratulations, %s!", $name);
}
