<?php
declare(strict_types=1);

namespace Pejman\Agi\Tts;

interface TtsEngineInterface
{
    public function synthesize(string $text, array $options = []): string;
}