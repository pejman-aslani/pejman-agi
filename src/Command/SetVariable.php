<?php
declare(strict_types=1);

namespace Pejman\Agi\Command;

final class SetVariable implements CommandInterface
{
    public function __construct(
        private readonly string $variable,
        private readonly string|int|float $value
    ) {}

    public function getCommand(): string
    {
        $value = is_numeric($this->value) ? $this->value : '"' . str_replace('"', '\\"', (string)$this->value) . '"';
        return "SET VARIABLE \"{$this->variable}\" {$value}";
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}