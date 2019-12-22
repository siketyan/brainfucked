<?php

declare(strict_types=1);

namespace Siketyan\Brainfucked\Runtime;

class Sourcemap
{
    /**
     * @var string the name of the source file or stream
     */
    private $source;

    /**
     * @var string the position in the source
     */
    private $position;

    /**
     * Sourcemap constructor.
     *
     * @param string $source   the name of the source file or stream
     * @param string $position the position in the source
     */
    public function __construct(string $source, string $position)
    {
        $this->source = $source;
        $this->position = $position;
    }

    /**
     * Converts the sourcemap to string that shows where the operation in the source.
     *
     * @return string the converted string
     */
    public function __toString(): string
    {
        return $this->source . ':' . $this->position;
    }

    /**
     * Gets the name of the source file or stream.
     *
     * @return string the name of the source file or stream
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Gets the position in the source.
     *
     * @return string the position in the source
     */
    public function getPosition(): string
    {
        return $this->position;
    }
}
