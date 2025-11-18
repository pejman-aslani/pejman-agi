<?php

declare(strict_types=1);

namespace Pejman\src\Command;

use Pejman\Agi\Command\CommandInterface;

final readonly class SendText implements CommandInterface
{
    /**
     * @param string $text متنی که باید به کانال فرستاده شود.
     */
    public function __construct(
        private string $text,
    ) {
    }

    public function getCommand(): string
    {
        // SEND TEXT <text>
        // Asterisk نیاز دارد که مقدار در دابل کوتیشن باشد
        return sprintf('SEND TEXT "%s"', $this->text);
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}