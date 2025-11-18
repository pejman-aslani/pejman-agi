<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class SetCallerId implements CommandInterface
{
    public function __construct(private string $callerId) {}
    public function getCommand(): string
    {
        return "SET CALLERID \"{$this->callerId}\"";
    }
    public function __toString(): string
    {
        return $this->getCommand();
    }
}
