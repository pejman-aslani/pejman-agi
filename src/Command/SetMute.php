<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class SetMute implements CommandInterface
{
    public function __construct(private bool $status) {}
    public function getCommand(): string
    {
        return 'SET MUTE ' . ($this->status ? 'on' : 'off');
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
