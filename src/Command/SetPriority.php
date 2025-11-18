<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final class SetPriority implements CommandInterface
{
    public function __construct(private string $priority) {}

    public function getCommand(): string
    {
        return "SET PRIORITY {$this->priority}";
    }

    public function __toString(): string
    {
        // ← این خط کاملاً درست شد (M حذف شد!)
        return $this->getCommand();
    }
}
