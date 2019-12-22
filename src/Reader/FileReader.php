<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Reader;

use Siketyan\Brainfucked\Exception\IOException;

class FileReader extends StringReader
{
    /**
     * @var string the name of the source file
     */
    private $name;

    public function __construct(string $uri)
    {
        $this->name = basename($uri);
        $buffer = @file_get_contents($uri);

        if ($buffer === false) {
            throw new IOException(
                sprintf(
                    'Failed to open the file: %s',
                    $uri
                )
            );
        }

        parent::__construct($buffer);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->name;
    }
}
