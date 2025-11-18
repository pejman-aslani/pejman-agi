<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class SetAgiText implements CommandInterface
{
    public function __construct(private string $text) {}

    public function getCommand(): string
    {
        // ← اینجا $this-> اضافه شد
        return "VERBOSE \"{$this->text}\" 1";
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}