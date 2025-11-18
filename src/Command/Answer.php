<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final readonly class Answer implements CommandInterface
{
    /**
     * دستور خام AGI را برمی‌گرداند.
     * * @return string
     */
    public function getCommand(): string
    {
        return 'ANSWER';
    }

    /**
     * این متد توسط تابع execute فراخوانی می‌شود و دستور را به یک رشته تبدیل می‌کند.
     * * @return string
     */
    public function __toString(): string
    {
        return $this->getCommand();
    }
}