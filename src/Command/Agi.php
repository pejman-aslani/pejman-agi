<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class Agi implements CommandInterface
{
    public function __construct(private string $uri) {}
    public function getCommand(): string
    {
        return "EXEC AGI \"{$this->uri}\"";
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
