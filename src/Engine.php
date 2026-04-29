<?php

declare(strict_types=1);

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const MAX_ATTEMPTS = 3;

function gameLoop(
    array $gameData
): void {
    [$description, $questions, $correctAnswers] = $gameData;

    line("Welcome to the Brain Games!");

    $name = prompt("May I have your name?", false, ' ');
    line("Hello, %s!", $name);

    line($description);

    for ($i = 0; $i < MAX_ATTEMPTS; $i++) {
        line('Question: %s', $questions[$i]);

        $correctAnswer = $correctAnswers[$i];
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
