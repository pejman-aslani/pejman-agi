<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class Exec implements CommandInterface
{
    public function __construct(
        private readonly string $application,
        private readonly string|array $options = []
    ) {}

    public function getCommand(): string
    {
        $opts = is_array($this->options) ? implode('|', $this->options) : $this->options;
        $opts = $opts !== '' ? '"' . $opts . '"' : '';
        return 'EXEC ' . $this->application . ' ' . $opts;
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}