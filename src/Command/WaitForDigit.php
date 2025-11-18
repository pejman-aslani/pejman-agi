<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class WaitForDigit implements CommandInterface
{
    public function __construct(private readonly int $timeout = -1) {}

    public function getCommand(): string
    {
        return 'WAIT FOR DIGIT ' . $this->timeout;
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}