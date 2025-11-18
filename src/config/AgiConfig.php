<?php

declare(strict_types=1);

namespace Pejman\src\config;

/**
 * تنظیمات کلی کلاینت AGI
 */
final readonly class AgiConfig
{
    public function __construct(
        public string $asteriskSoundsPath = '/var/lib/asterisk/sounds/',
        public string $defaultTtsLang = 'fa',
    ) {
    }
}