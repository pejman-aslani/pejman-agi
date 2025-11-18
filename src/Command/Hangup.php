<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class Hangup implements CommandInterface
{
    public function __construct(private readonly ?string $channel = null) {}

    public function getCommand(): string
    {
        return 'HANGUP' . ($this->channel ? ' "'.$this->channel.'"' : '');
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}