<?php

declare(strict_types=1);

namespace Pejman\Agi\Command;

final readonly class DatabaseGet implements CommandInterface
{
    public function __construct(
        private string $family,
        private string $key,
    ) {
    }

    /**
     * ✅ پیاده‌سازی متد مورد نیاز در رابط (getCommand)
     * این متد رشته خام AGI را برمی‌گرداند.
     */
    public function getCommand(): string
    {
        return 'DATABASE GET "' . $this->family . '" "' . $this->key . '"';
    }

    /**
     * ✅ پیاده‌سازی متد جادویی (__toString)
     * در اینجا، ما می‌توانیم برای حفظ یکپارچگی، متد getCommand() را فراخوانی کنیم.
     */
    public function __toString(): string
    {
        return $this->getCommand();
    }
}