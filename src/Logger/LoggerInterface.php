<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Logger;

use Siketyan\Brainfucked\Runtime\Operation;

interface LoggerInterface
{
    /**
     * Logs the operation.
     *
     * @param Operation $operation the operation to run
     */
    public function log(Operation $operation): void;
}
