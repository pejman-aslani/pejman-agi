<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class ChannelStatus implements CommandInterface
{
    public function __construct(private ?string $channel = null) {}
    public function getCommand(): string
    {
        return 'CHANNEL STATUS' . ($this->channel ? " \"{$this->channel}\"" : '');
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
