<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class DatabasePut implements CommandInterface
{
    public function __construct(
        private readonly string $family,
        private readonly string $key,
        private readonly string $value
    ) {}

    public function getCommand(): string
    {
        $value = str_replace('"', '\\"', $this->value);
        return sprintf('DATABASE PUT "%s" "%s" "%s"', $this->family, $this->key, $value);
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}