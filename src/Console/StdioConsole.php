<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Console;

class StdioConsole extends FileConsole
{
    private const INPUT_URL = 'php://stdin';
    private const OUTPUT_URL = 'php://stdout';

    public function __construct()
    {
        parent::__construct(self::INPUT_URL, self::OUTPUT_URL);
    }
}
