<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class StreamFile implements CommandInterface
{
    public function __construct(
        private readonly string $filename,
        private readonly string $escapeDigits = '',
        private readonly int $offset = 0
    ) {}

    public function getCommand(): string
    {
        return sprintf(
            'STREAM FILE "%s" "%s" %d',
            $this->filename,
            $this->escapeDigits,
            $this->offset
        );
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}