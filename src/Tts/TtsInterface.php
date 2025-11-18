<?php

declare(strict_types=1);

namespace Pejman\src\Tts;

/**
 * رابط استاندارد برای تمام پیاده سازی های Text-to-Speech.
 *
 * تضمین می کند که هر موتور TTS یک متد synthesize داشته باشد.
 */
interface TtsInterface
{
    /**
     * متن را به یک فایل صوتی (WAV) تبدیل می کند و مسیر کامل فایل تولید شده را برمی گرداند.
     *
     * @param string $text متنی که باید گفته شود.
     * @param array $options گزینه های موتور خاص (مثلاً voice، speed، pitch).
     * @return string مسیر کامل فایل WAV تولید شده.
     * @throws \Pejman\Agi\Exception\TtsException در صورت بروز خطا در فرآیند سنتز.
     */
    public function synthesize(string $text, array $options = []): string;
}