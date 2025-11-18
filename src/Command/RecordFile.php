<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class RecordFile implements CommandInterface
{
    public function __construct(
        private string $filename,
        private string $format,
        private string $escapeDigits = '',
        private int $timeout = -1,
        private bool $beep = false,
        private int $silence = 0
    ) {}
    public function getCommand(): string
    {
        $cmd = "RECORD FILE \"{$this->filename}\" {$this->format} \"{$this->escapeDigits}\" {$this->timeout}";
        if ($this->beep) $cmd .= " BEEP";
        if ($this->silence > 0) $cmd .= " s={$this->silence}";
        return $cmd;
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
