<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class GetVariable implements CommandInterface
{
    public function __construct(private readonly string $variable) {}

    public function getCommand(): string
    {
        return 'GET VARIABLE "' . $this->variable . '"';
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}