<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class Dial implements CommandInterface
{
    public function __construct(private string $destination, private int $timeout = 30, private string $options = '') {}
    public function getCommand(): string
    {
        return "DIAL {$this->destination}|{$this->timeout}|{$this->options}";
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
