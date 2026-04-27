<?php

declare(strict_types=1);

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const MAX_ATTEMPTS = 3;

function gameLoop(
    string $textGoal,
    callable $generatorQuestion,
    callable $generatorCorrectAnswer,
    callable $checkerAnswer
): void {
    line("Welcome to the Brain Games!");

    $name = prompt("May I have your name?", false, ' ');
    line("Hello, %s!", $name);

    line($textGoal);

    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        $question = $generatorQuestion();
        line('Question: %s', $question);

        $userAnswer = prompt("Your answer");

        $correctAnswer = $generatorCorrectAnswer($question);
        if (!$checkerAnswer($userAnswer, $correctAnswer)) {
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
