<?php

declare(strict_types=1);

namespace BrainGames\Cli;

use function cli\line;
use function cli\prompt;

function welcomeUser(): void
{
    line("Welcome to the Brain Games!\n");

    $name = prompt("May I have your name?\n");
    line("Hello, %s!\n", $name);
}
