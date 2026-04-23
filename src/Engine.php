<?php

declare(strict_types=1);

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

function welcomeUser(): string
{
    line("Welcome to the Brain Game!");

    $name = prompt("May I have your name?", false, ' ');
    line("Hello, %s!", $name);

    return $name;
}

function askQuestion($question)
{
    line('Question: %s', $question);
}

function makeAnswer(): string
{
    $answer = prompt("Your answer");
    return $answer;
}

function congratulateUser(string $name): void
{
    line("Congratulations, %s!", $name);
}

function tryAgain($userAnswer, $correctAnswer, string $name): void
{
    line(
        "'%s' is wrong answer ;(. Correct answer was '%s'.",
        $userAnswer,
        $correctAnswer
    );

    line("Let's try again, %s!", $name);
}

function gameLoop(
    string $textGoal,
    callable $generatorQuestion,
    callable $generatorCorrectAnswer,
    callable $checkerAnswer
): void {
    $name = welcomeUser();

    line($textGoal);

    $countAttempts = 3;

    for ($i = 0; $i < $countAttempts; $i++) {
        $question = $generatorQuestion();
        askQuestion($question);

        $userAnswer = makeAnswer();

        $correctAnswer = $generatorCorrectAnswer($question);
        if (!$checkerAnswer($userAnswer, $correctAnswer)) {
            tryAgain($userAnswer, $correctAnswer, $name);
            return;
        }

        line("Correct!");
    }

    congratulateUser($name);
}
