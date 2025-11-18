<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class DatabaseDel implements CommandInterface
{
    public function __construct(
        private readonly string $family,
        private readonly string $key
    ) {}

    public function getCommand(): string
    {
        return sprintf('DATABASE DEL "%s" "%s"', $this->family, $this->key);
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}