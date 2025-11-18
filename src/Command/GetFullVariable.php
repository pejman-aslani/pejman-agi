<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class GetFullVariable implements CommandInterface
{
    public function __construct(private string $variable, private ?string $channel = null) {}
    public function getCommand(): string
    {
        return 'GET FULL VARIABLE ' . ($this->channel ? "\"{$this->variable}\" \"{$this->channel}\"" : "\"{$this->variable}\"");
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
