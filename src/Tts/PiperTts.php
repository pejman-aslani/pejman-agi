<?php
declare(strict_types=1);

namespace Pejman\Agi\Tts;

use RuntimeException;

final class PiperTts implements TtsEngineInterface
{
    private string $cacheDir;

    public function __construct(
        private readonly string $modelPath = '/usr/share/piper-voices/fa_IR-kiana-medium.onnx',
        ?string $cacheDir = null
    ) {
        $this->cacheDir = $cacheDir ?? sys_get_temp_dir() . '/agi_piper_cache';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function synthesize(string $text, array $options = []): string
    {
        $text = trim($text);
        if ($text === '') {
            throw new \InvalidArgumentException('Text is empty');
        }

        $hash = md5($text . serialize($options));
        $wavFile = $this->cacheDir . "/piper_$hash.wav";

        if (file_exists($wavFile)) {
            return $wavFile;
        }

        // پاک کردن کاراکترهای خطرناک
        $safeText = preg_replace('/[^آ-یءآاژبپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی\s\.\،\!\?\(\)]/u', '', $text);

        $cmd = sprintf(
            'echo %s | piper --model %s --output_file %s --cuda %s 2>/dev/null',
            escapeshellarg($safeText),
            escapeshellarg($this->modelPath),
            escapeshellarg($wavFile),
            extension_loaded('cuda') ? '--cuda' : '--cpu' // اگر GPU داری خودکار استفاده می‌کنه
        );

        exec($cmd, $output, $return);

        if ($return !== 0 || !file_exists($wavFile)) {
            throw new RuntimeException('Piper TTS failed: ' . implode("\n", $output));
        }

        // پاک کردن فایل‌های قدیمی‌تر از ۳۰ روز
        $this->cleanupOldCache();

        return $wavFile;
    }

    private function cleanupOldCache(): void
    {
        foreach (glob($this->cacheDir . '/piper_*.wav') ?: [] as $file) {
            if (filemtime($file) < time() - 2592000) { // 30 روز
                @unlink($file);
            }
        }
    }
}