<?php
declare(strict_types=1);

namespace Pejman\Agi\Command;

final class SayNumber implements CommandInterface
{
    public function __construct(
        private readonly int $number,
        private readonly string $escapeDigits = ''
    ) {}

    public function getCommand(): string
    {
        return sprintf('SAY NUMBER %d "%s"', $this->number, $this->escapeDigits);
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}