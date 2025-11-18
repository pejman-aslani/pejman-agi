<?php

declare(strict_types=1);

namespace Pejman\src\Command;
use Pejman\Agi\Command\CommandInterface;

final readonly class GetOption implements CommandInterface
{
    /**
     * @param string $filename فایلی که باید پخش شود (بدون پسوند).
     * @param string $escapeDigits ارقام فشاری که پخش را متوقف می‌کنند و به عنوان نتیجه برمی‌گردند.
     * @param int $timeout در میلی‌ثانیه، -1 به معنی نامحدود.
     */
    public function __construct(
        private string $filename,
        private string $escapeDigits,
        private int $timeout = -1,
    ) {
    }

    public function getCommand(): string
    {
        // GET OPTION <filename> <escape_digits> <timeout>
        return sprintf(
            'GET OPTION "%s" "%s" %d',
            $this->filename,
            $this->escapeDigits,
            $this->timeout
        );
    }

    public function __toString(): string
    {
        return $this->getCommand();
    }
}