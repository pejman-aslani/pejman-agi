<?php

declare(strict_types=1);

namespace Pejman\Agi;

final class Response
{
    private function __construct(
        public readonly int $code,
        public readonly int $result,
        public readonly string $data,
        public readonly ?string $extra = null,
        public readonly ?int $endpos = null,
    ) {}

    public static function fromRaw(string $line, string $fullResponse = ''): self
    {
        $line = trim($line);

        if (!preg_match('/^(\d{3}) result=([-\d]+)(?: \((.*)\))?/', $line, $m)) {
            throw new Exception\AgiException("Invalid AGI response: $line");
        }

        $code = (int)$m[1];
        $result = (int)$m[2];
        $paren = $m[3] ?? '';

        // پارس ساده data و endpos
        $data = trim(str_replace($paren, '', $fullResponse));
        $extra = $paren ?: null;
        $endpos = null;

        if (preg_match('/endpos=(\d+)/i', $fullResponse, $em)) {
            $endpos = (int)$em[1];
        }

        return new self($code, $result, $data, $extra, $endpos);
    }

    public function isSuccess(): bool
    {
        return $this->code === 200;
    }

    public function isHangup(): bool
    {
        return $this->result === -1 && str_contains($this->data, 'hangup');
    }
}