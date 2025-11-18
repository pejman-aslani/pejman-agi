<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class Gosub implements CommandInterface
{
    public function __construct(private string $context, private string $extension, private string $priority = '1', private string $args = '') {}
    public function getCommand(): string
    {
        $cmd = "GOSUB {$this->context} {$this->extension} {$this->priority}";
        if ($this->args !== '') $cmd .= " {$this->args}";
        return $cmd;
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
