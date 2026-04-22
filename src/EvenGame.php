<?php

declare(strict_types=1);

namespace BrainGames\EvenGame;

use function cli\line;
use function cli\prompt;

function run(): void
{
    line("Welcome to the Brain Game!");

    $name = prompt("May I have your name?", false, ' ');
    line("Hello, %s!", $name);

    line('Answer "yes" if the number is even, otherwise answer "no".');

    $countAttempts = 3;
    $expectedAnswers = [
        'no',
        'yes'
    ];

    for ($i = 0; $i < $countAttempts; $i++) {
        $randomNumber = rand(0, 100);
        $isEven = $randomNumber % 2 == 0;
        line('Question: %d', $randomNumber);

        $answer = prompt("Your answer");
        $correctAnswer = $expectedAnswers[(int)$isEven];
        if (!in_array($answer, $expectedAnswers) || $correctAnswer != $answer) {
            line(
                "'%s' is wrong answer ;(. Correct answer was '%s'. Let's try again, %s!",
                $answer,
                $correctAnswer,
                $name
            );
            return;
        }

        line("Correct!");
    }

    line("Congratulations, %s!", $name);
}
