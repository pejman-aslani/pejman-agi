<?php

declare(strict_types=1);

namespace Pejman\src\config;

/**
 * تنظیمات خاص برای موتور TTS Piper.
 */
final readonly class PiperConfig
{
    public function __construct(
        // مسیر کامل به فایل اجرایی piper (مثلاً /usr/local/bin/piper)
        public string $binaryPath = '/usr/local/bin/piper',
        // مسیر دایرکتوری که مدل های صوتی در آن قرار دارند (models/)
        public string $modelDirectory = '/path/to/piper/models/',
        // مسیر دایرکتوری برای ذخیره فایل های موقت TTS (باید قابل نوشتن باشد)
        public string $cacheDirectory = '/tmp/agi_tts_cache/',
        // نام مدل پیش فرض برای استفاده (مثلاً fa_ir-vits)
        public string $defaultModel = 'fa_ir-vits', 
    ) {
    }
}