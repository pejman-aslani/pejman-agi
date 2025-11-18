<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class GetData implements CommandInterface
{
    public function __construct(
        private readonly string $filename,
        private readonly ?int $timeout = null,
        private readonly ?int $maxDigits = null
    ) {}

    public function getCommand(): string
    {
        $cmd = 'GET DATA "' . $this->filename . '"'; // ← اینجا $this-> اضافه شد

        if ($this->timeout !== null) {
            $cmd .= ' ' . $this->timeout;
        }

        if ($this->maxDigits !== null) {
            $cmd .= ' ' . $this->maxDigits;
        }

        return $cmd;
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}