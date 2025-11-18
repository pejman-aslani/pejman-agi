<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

interface CommandInterface
{
    public function getCommand(): string;
    public function __toString(): string;
}